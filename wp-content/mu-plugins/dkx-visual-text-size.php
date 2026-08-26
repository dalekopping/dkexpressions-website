<?php
/**
 * Plugin Name: DK Expressions Visual Text Size
 * Description: Adds safe per-element text-size controls to DK Visual Page Studio without altering the approved layout system.
 * Version: 1.0.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function dkx_text_size_overrides( $post_id ) {
	$data = get_post_meta( absint( $post_id ), '_dkx_visual_text_sizes', true );
	return is_array( $data ) ? $data : array();
}

function dkx_text_size_clean_path( $path ) {
	$path = substr( trim( (string) $path ), 0, 1000 );
	if ( function_exists( 'dkxv4_visual_sanitize_path' ) ) return dkxv4_visual_sanitize_path( $path );
	return preg_match( '/^[A-Za-z0-9_#.:>+~*()\-\[\]="\'\s]+$/', $path ) ? $path : '';
}

function dkx_text_size_ajax() {
	$post_id = isset( $_POST['postId'] ) ? absint( wp_unslash( $_POST['postId'] ) ) : 0;
	check_ajax_referer( 'dkxv4_visual_editor_' . $post_id, 'nonce' );
	if ( ! $post_id || ! current_user_can( 'edit_post', $post_id ) ) {
		wp_send_json_error( array( 'message' => 'You are not allowed to edit this page.' ), 403 );
	}

	$path = dkx_text_size_clean_path( isset( $_POST['path'] ) ? wp_unslash( $_POST['path'] ) : '' );
	if ( ! $path ) wp_send_json_error( array( 'message' => 'This text element could not be identified safely.' ), 400 );

	$action = sanitize_key( isset( $_POST['command'] ) ? wp_unslash( $_POST['command'] ) : 'set' );
	$sizes  = dkx_text_size_overrides( $post_id );

	if ( 'reset' === $action ) {
		unset( $sizes[ $path ] );
		if ( $sizes ) update_post_meta( $post_id, '_dkx_visual_text_sizes', $sizes ); else delete_post_meta( $post_id, '_dkx_visual_text_sizes' );
		wp_send_json_success( array( 'message' => 'Text size restored to the DK default.' ) );
	}

	$size = isset( $_POST['size'] ) ? (float) wp_unslash( $_POST['size'] ) : 0;
	$size = max( 8, min( 160, $size ) );
	$sizes[ $path ] = round( $size, 1 );
	update_post_meta( $post_id, '_dkx_visual_text_sizes', $sizes );
	wp_send_json_success( array( 'message' => 'Text size updated.', 'size' => $sizes[ $path ] ) );
}
add_action( 'wp_ajax_dkx_visual_text_size', 'dkx_text_size_ajax' );

/** Apply saved sizes to the public page and expose editor messaging inside the signed visual canvas. */
function dkx_text_size_canvas_runtime() {
	if ( ! is_singular( array( 'page', 'post' ) ) ) return;
	$post_id = get_queried_object_id();
	if ( ! $post_id ) return;
	$sizes  = dkx_text_size_overrides( $post_id );
	$editor = function_exists( 'dkxv4_is_visual_canvas_request' ) && dkxv4_is_visual_canvas_request( $post_id );
	if ( ! $sizes && ! $editor ) return;
	?>
	<script id="dkx-visual-text-size-runtime">
	(function(){
	'use strict';
	var cfg={editor:<?php echo $editor ? 'true' : 'false'; ?>,sizes:<?php echo wp_json_encode( $sizes ); ?>};
	function esc(v){if(window.CSS&&CSS.escape)return CSS.escape(v);return String(v).replace(/[^a-zA-Z0-9_-]/g,'\\$&');}
	function path(el){if(!el||el.nodeType!==1)return '';if(el.id&&document.querySelectorAll('#'+esc(el.id)).length===1)return '#'+esc(el.id);var parts=[],cur=el;while(cur&&cur.nodeType===1&&cur!==document.body){var part=cur.tagName.toLowerCase(),par=cur.parentElement;if(cur.id&&document.querySelectorAll('#'+esc(cur.id)).length===1){parts.unshift('#'+esc(cur.id));break;}if(par){var sib=[].filter.call(par.children,function(x){return x.tagName===cur.tagName;});if(sib.length>1)part+=':nth-of-type('+(sib.indexOf(cur)+1)+')';}parts.unshift(part);if(cur.tagName.toLowerCase()==='main')break;cur=par;}return parts.join(' > ');}
	function find(p){try{return document.querySelector(p);}catch(e){return null;}}
	function apply(p,size){var el=find(p);if(el&&size){el.style.setProperty('font-size',String(size)+'px','important');}}
	Object.keys(cfg.sizes||{}).forEach(function(p){apply(p,cfg.sizes[p]);});
	if(!cfg.editor)return;
	function target(start){if(!start||!start.closest)return null;var el=start.closest('[data-dkx-field],h1,h2,h3,h4,h5,h6,p,li,blockquote,figcaption,a,button,label,strong,b,em,span,small');return el&&el.closest('main')?el:null;}
	function post(m){if(window.parent&&window.parent!==window)window.parent.postMessage(m,window.location.origin);}
	document.addEventListener('click',function(e){var el=target(e.target);if(!el)return;var p=path(el),computed=parseFloat(window.getComputedStyle(el).fontSize)||16;setTimeout(function(){post({type:'dkx-text-size-info',path:p,size:computed,tag:el.tagName.toLowerCase()});},10);},true);
	window.addEventListener('message',function(e){if(e.origin!==window.location.origin||!e.data||!e.data.type)return;if(e.data.type==='dkx-text-size-live'){var el=find(e.data.path);if(el)el.style.setProperty('font-size',String(e.data.size)+'px','important');}if(e.data.type==='dkx-text-size-reset-live'){var el=find(e.data.path);if(el)el.style.removeProperty('font-size');}});
	}());
	</script>
	<?php
}
add_action( 'wp_footer', 'dkx_text_size_canvas_runtime', 2 );

/** Add text-size controls to the existing DK Visual Page Studio inspector. */
function dkx_text_size_admin_runtime() {
	if ( ! is_admin() || empty( $_GET['page'] ) || 'dkx-visual-page-editor' !== sanitize_key( wp_unslash( $_GET['page'] ) ) ) return;
	$post_id = isset( $_GET['post'] ) ? absint( wp_unslash( $_GET['post'] ) ) : 0;
	if ( ! $post_id || ! current_user_can( 'edit_post', $post_id ) ) return;
	?>
	<style>
	.dkx-text-size-tools{margin-top:14px;padding:14px;border:1px solid #264557;background:#07131c}.dkx-text-size-tools__label{display:block;margin-bottom:9px;color:#40b8ff;font-size:10px;font-weight:800;letter-spacing:.14em;text-transform:uppercase}.dkx-text-size-row{display:grid;grid-template-columns:42px minmax(76px,1fr) 42px;gap:7px;align-items:center}.dkx-text-size-row input{width:100%;min-height:36px;text-align:center;background:#02070c!important;color:#fff!important;border:1px solid #315166!important}.dkx-text-size-unit{margin-top:7px;color:#9db2c2;font-size:11px}.dkx-text-size-actions{display:flex;gap:8px;margin-top:10px;flex-wrap:wrap}
	</style>
	<script>
	(function($){
	'use strict';
	var root=document.querySelector('[data-dkx-visual-studio]');if(!root)return;
	var panel=root.querySelector('[data-dkx-selection]'),frame=root.querySelector('#dkx-visual-canvas'),status=root.querySelector('[data-dkx-status]');
	var current=null,ajax=<?php echo wp_json_encode( admin_url( 'admin-ajax.php' ) ); ?>,postId=<?php echo (int) $post_id; ?>,nonce=<?php echo wp_json_encode( wp_create_nonce( 'dkxv4_visual_editor_' . $post_id ) ); ?>;
	function setStatus(state,title,copy){if(!status)return;status.setAttribute('data-state',state);status.querySelector('strong').textContent=title;status.querySelector('span').textContent=copy;}
	function send(m){if(frame&&frame.contentWindow)frame.contentWindow.postMessage(m,window.location.origin);}
	function draw(){var old=root.querySelector('.dkx-text-size-tools');if(old)old.remove();if(!panel||panel.hidden||!current)return;var box=document.createElement('div');box.className='dkx-text-size-tools';box.innerHTML='<span class="dkx-text-size-tools__label">Text size</span><div class="dkx-text-size-row"><button type="button" class="button" data-dkx-font-minus>−</button><input type="number" min="8" max="160" step="1" value="'+Math.round(current.size)+'" data-dkx-font-size aria-label="Font size in pixels"><button type="button" class="button" data-dkx-font-plus>+</button></div><div class="dkx-text-size-unit">Pixels · minimum 8px · maximum 160px</div><div class="dkx-text-size-actions"><button type="button" class="button button-primary" data-dkx-font-apply>Apply text size</button><button type="button" class="button" data-dkx-font-reset>Restore DK default</button></div>';var actions=panel.querySelector('.dkx-vps__selection-actions');if(actions)actions.insertAdjacentElement('afterend',box);else panel.appendChild(box);}
	function save(command,size){if(!current)return;setStatus('saving',command==='reset'?'Restoring text size':'Updating text size','Applying the change without altering the DK layout or colour system.');$.post(ajax,{action:'dkx_visual_text_size',nonce:nonce,postId:postId,command:command,path:current.path,size:size},null,'json').done(function(r){if(!r||!r.success){setStatus('error','Text size update failed',r&&r.data&&r.data.message?r.data.message:'WordPress could not save this size.');return;}if(command==='reset'){send({type:'dkx-text-size-reset-live',path:current.path});setStatus('saved','Text size restored','The original DK responsive size is active again.');}else{send({type:'dkx-text-size-live',path:current.path,size:r.data.size});current.size=parseFloat(r.data.size)||size;setStatus('saved','Text size updated','Only the selected text size changed. Layout, font family and DK styling remain intact.');draw();}}).fail(function(){setStatus('error','Text size update failed','The server rejected the change.');});}
	window.addEventListener('message',function(e){if(e.origin!==window.location.origin||!e.data)return;if(e.data.type==='dkx-text-size-info'){current=e.data;setTimeout(draw,0);}});
	root.addEventListener('click',function(e){var input=root.querySelector('[data-dkx-font-size]');if(e.target.closest('[data-dkx-font-minus]')&&input){input.value=Math.max(8,(parseFloat(input.value)||16)-1);return;}if(e.target.closest('[data-dkx-font-plus]')&&input){input.value=Math.min(160,(parseFloat(input.value)||16)+1);return;}if(e.target.closest('[data-dkx-font-apply]')&&input){save('set',Math.max(8,Math.min(160,parseFloat(input.value)||16)));return;}if(e.target.closest('[data-dkx-font-reset]')){save('reset',0);return;}});
	}(jQuery));
	</script>
	<?php
}
add_action( 'admin_footer', 'dkx_text_size_admin_runtime', 100 );
