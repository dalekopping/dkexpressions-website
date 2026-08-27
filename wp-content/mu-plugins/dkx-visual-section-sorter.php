<?php
/**
 * Plugin Name: DK Expressions Visual Section Sorter
 * Description: Drag-and-drop ordering for top-level DK page sections without changing their approved styling.
 * Version: 1.0.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function dkx_section_order( $post_id ) {
	$order = get_post_meta( absint( $post_id ), '_dkx_visual_section_order', true );
	return is_array( $order ) ? array_values( array_filter( array_map( 'sanitize_text_field', $order ) ) ) : array();
}

function dkx_section_sorter_ajax() {
	$post_id = isset( $_POST['postId'] ) ? absint( wp_unslash( $_POST['postId'] ) ) : 0;
	check_ajax_referer( 'dkxv4_visual_editor_' . $post_id, 'nonce' );
	if ( ! $post_id || ! current_user_can( 'edit_post', $post_id ) ) {
		wp_send_json_error( array( 'message' => 'You are not allowed to reorder this page.' ), 403 );
	}
	$raw = isset( $_POST['order'] ) ? json_decode( wp_unslash( $_POST['order'] ), true ) : array();
	if ( ! is_array( $raw ) ) $raw = array();
	$order = array();
	foreach ( array_slice( $raw, 0, 100 ) as $key ) {
		$key = sanitize_text_field( (string) $key );
		if ( $key && preg_match( '/^[A-Za-z0-9_#.:>+~*()\-\[\]="\'\s]+$/', $key ) ) $order[] = substr( $key, 0, 1000 );
	}
	$order = array_values( array_unique( $order ) );
	if ( $order ) update_post_meta( $post_id, '_dkx_visual_section_order', $order );
	else delete_post_meta( $post_id, '_dkx_visual_section_order' );
	wp_send_json_success( array( 'message' => 'Section order saved.', 'order' => $order ) );
}
add_action( 'wp_ajax_dkx_visual_save_section_order', 'dkx_section_sorter_ajax' );

/**
 * Frontend/canvas runtime. Reorders only siblings under the same parent.
 * This protects fixed shell elements such as the hero/header from accidental relocation.
 */
function dkx_section_sorter_runtime() {
	if ( ! is_singular( array( 'page', 'post' ) ) ) return;
	$post_id = get_queried_object_id();
	if ( ! $post_id ) return;
	$order = dkx_section_order( $post_id );
	$editor = function_exists( 'dkxv4_is_visual_canvas_request' ) && dkxv4_is_visual_canvas_request( $post_id );
	if ( ! $order && ! $editor ) return;
	?>
	<script id="dkx-section-sorter-runtime">
	(function(){
		'use strict';
		var cfg={editor:<?php echo $editor ? 'true' : 'false'; ?>,order:<?php echo wp_json_encode( $order ); ?>};
		function cssEscape(v){if(window.CSS&&CSS.escape)return CSS.escape(v);return String(v).replace(/[^a-zA-Z0-9_-]/g,'\\$&');}
		function path(el){
			if(!el||el.nodeType!==1)return '';
			var key=el.getAttribute('data-dkx-section-key');
			if(key)return '[data-dkx-section-key="'+key.replace(/"/g,'\\"')+'"]';
			if(el.id&&document.querySelectorAll('#'+cssEscape(el.id)).length===1)return '#'+cssEscape(el.id);
			var parts=[],cur=el;
			while(cur&&cur.nodeType===1&&cur!==document.body){
				var part=cur.tagName.toLowerCase(),parent=cur.parentElement;
				if(cur.id&&document.querySelectorAll('#'+cssEscape(cur.id)).length===1){parts.unshift('#'+cssEscape(cur.id));break;}
				if(parent){var siblings=[].filter.call(parent.children,function(x){return x.tagName===cur.tagName;});if(siblings.length>1)part+=':nth-of-type('+(siblings.indexOf(cur)+1)+')';}
				parts.unshift(part);if(cur.tagName.toLowerCase()==='main')break;cur=parent;
			}
			return parts.join(' > ');
		}
		function find(p){try{return document.querySelector(p);}catch(e){return null;}}
		function candidates(){
			var main=document.querySelector('main'); if(!main)return [];
			return [].filter.call(main.children,function(el){
				if(!el||el.nodeType!==1)return false;
				if(el.hasAttribute('data-dkx-section-key'))return true;
				return el.tagName==='SECTION'||el.tagName==='ASIDE';
			});
		}
		function label(el,index){
			var h=el.querySelector('h1,h2,h3');
			var txt=h?(h.innerText||'').replace(/\s+/g,' ').trim():'';
			if(!txt)txt=el.getAttribute('aria-label')||el.id||el.getAttribute('data-dkx-section-key')||('Section '+(index+1));
			return txt.substring(0,90);
		}
		function apply(order){
			if(!Array.isArray(order)||!order.length)return;
			var resolved=order.map(function(p){return {p:p,el:find(p)};}).filter(function(x){return x.el&&x.el.parentElement;});
			var groups=[];
			resolved.forEach(function(x){var g=groups.find(function(y){return y.parent===x.el.parentElement;});if(!g){g={parent:x.el.parentElement,items:[]};groups.push(g);}g.items.push(x.el);});
			groups.forEach(function(g){g.items.forEach(function(el){g.parent.appendChild(el);});});
		}
		function sendList(){
			if(!cfg.editor||!window.parent||window.parent===window)return;
			var list=candidates().map(function(el,i){return {path:path(el),label:label(el,i),key:el.getAttribute('data-dkx-section-key')||'',tag:el.tagName.toLowerCase()};});
			window.parent.postMessage({type:'dkx-section-list',sections:list},window.location.origin);
		}
		function start(){apply(cfg.order);if(cfg.editor){sendList();setTimeout(sendList,250);}}
		window.addEventListener('message',function(e){if(e.origin!==window.location.origin||!e.data)return;if(e.data.type==='dkx-section-order-live'){apply(e.data.order||[]);sendList();}});
		if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',start);else start();
	}());
	</script>
	<?php
}
add_action( 'wp_footer', 'dkx_section_sorter_runtime', 2 );

function dkx_section_sorter_admin() {
	if ( ! is_admin() || empty( $_GET['page'] ) || 'dkx-visual-page-editor' !== sanitize_key( wp_unslash( $_GET['page'] ) ) ) return;
	$post_id = isset( $_GET['post'] ) ? absint( wp_unslash( $_GET['post'] ) ) : 0;
	if ( ! $post_id || ! current_user_can( 'edit_post', $post_id ) ) return;
	?>
	<style>
	.dkx-section-sorter{margin-top:16px;padding:15px;border:1px solid #264557;background:#07131c}.dkx-section-sorter h2{margin:0 0 5px;color:#fff;font-size:14px}.dkx-section-sorter>p{margin:0 0 12px;color:#9db2c2;font-size:12px;line-height:1.45}.dkx-section-sorter__list{display:grid;gap:7px}.dkx-section-sorter__item{display:grid;grid-template-columns:24px 1fr auto;align-items:center;gap:8px;padding:9px;border:1px solid #173342;background:#0a1d2a;color:#e6eef3;cursor:grab}.dkx-section-sorter__item.is-dragging{opacity:.45}.dkx-section-sorter__grip{color:#40b8ff;font-weight:800;text-align:center}.dkx-section-sorter__name{min-width:0;font-size:12px;font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.dkx-section-sorter__moves{display:flex;gap:4px}.dkx-section-sorter__moves button{width:26px;height:26px;padding:0;border:1px solid #36566a;background:#07131c;color:#e6eef3;cursor:pointer}.dkx-section-sorter__save{margin-top:10px;width:100%}.dkx-section-sorter__hint{display:block;margin-top:8px;color:#ffc34f;font-size:10px;font-weight:700;letter-spacing:.05em}
	</style>
	<script>
	(function($){
		'use strict';
		var root=document.querySelector('[data-dkx-visual-studio]');if(!root)return;
		var inspector=root.querySelector('.dkx-vps__inspector'),frame=root.querySelector('#dkx-visual-canvas'),status=root.querySelector('[data-dkx-status]');if(!inspector)return;
		var postId=<?php echo (int) $post_id; ?>,nonce=<?php echo wp_json_encode( wp_create_nonce( 'dkxv4_visual_editor_' . $post_id ) ); ?>,ajax=<?php echo wp_json_encode( admin_url( 'admin-ajax.php' ) ); ?>;
		var sections=[];
		var box=document.createElement('section');box.className='dkx-section-sorter';box.innerHTML='<h2>Section Order</h2><p>Drag the page sections into the order you want. Styling and content stay exactly as designed.</p><div class="dkx-section-sorter__list" data-dkx-section-list><span class="dkx-section-sorter__hint">Loading page sections…</span></div><button type="button" class="button button-primary dkx-section-sorter__save" data-dkx-save-order disabled>Save section order</button>';
		inspector.appendChild(box);
		var list=box.querySelector('[data-dkx-section-list]'),save=box.querySelector('[data-dkx-save-order]');
		function stat(state,title,copy){if(!status)return;status.setAttribute('data-state',state);status.querySelector('strong').textContent=title;status.querySelector('span').textContent=copy;}
		function currentOrder(){return [].map.call(list.querySelectorAll('[data-section-path]'),function(el){return el.getAttribute('data-section-path');});}
		function live(){if(frame&&frame.contentWindow)frame.contentWindow.postMessage({type:'dkx-section-order-live',order:currentOrder()},window.location.origin);save.disabled=false;stat('dirty','Section order changed','Save section order when you are happy with the page flow.');}
		function render(){
			list.innerHTML='';
			sections.forEach(function(s,i){var item=document.createElement('div');item.className='dkx-section-sorter__item';item.draggable=true;item.setAttribute('data-section-path',s.path);item.innerHTML='<span class="dkx-section-sorter__grip" title="Drag to move">≡</span><span class="dkx-section-sorter__name"></span><span class="dkx-section-sorter__moves"><button type="button" data-up aria-label="Move section up">↑</button><button type="button" data-down aria-label="Move section down">↓</button></span>';item.querySelector('.dkx-section-sorter__name').textContent=s.label;list.appendChild(item);});
			save.disabled=true;
		}
		window.addEventListener('message',function(e){if(e.origin!==window.location.origin||!e.data)return;if(e.data.type==='dkx-section-list'){sections=Array.isArray(e.data.sections)?e.data.sections:[];render();}});
		list.addEventListener('dragstart',function(e){var item=e.target.closest('.dkx-section-sorter__item');if(!item)return;item.classList.add('is-dragging');e.dataTransfer.effectAllowed='move';});
		list.addEventListener('dragend',function(e){var item=e.target.closest('.dkx-section-sorter__item');if(item)item.classList.remove('is-dragging');live();});
		list.addEventListener('dragover',function(e){e.preventDefault();var dragging=list.querySelector('.is-dragging');if(!dragging)return;var target=e.target.closest('.dkx-section-sorter__item');if(!target||target===dragging)return;var r=target.getBoundingClientRect();if(e.clientY<r.top+r.height/2)list.insertBefore(dragging,target);else list.insertBefore(dragging,target.nextSibling);});
		list.addEventListener('click',function(e){var item=e.target.closest('.dkx-section-sorter__item');if(!item)return;if(e.target.closest('[data-up]')&&item.previousElementSibling){list.insertBefore(item,item.previousElementSibling);live();}if(e.target.closest('[data-down]')&&item.nextElementSibling){list.insertBefore(item.nextElementSibling,item);live();}});
		save.addEventListener('click',function(){var order=currentOrder();save.disabled=true;stat('saving','Saving section order','Updating the page flow without changing the design.');$.post(ajax,{action:'dkx_visual_save_section_order',nonce:nonce,postId:postId,order:JSON.stringify(order)},null,'json').done(function(r){if(r&&r.success){stat('saved','Section order saved','The live page will now use this section order.');}else{save.disabled=false;stat('error','Could not save order',r&&r.data&&r.data.message?r.data.message:'WordPress could not save the section order.');}}).fail(function(){save.disabled=false;stat('error','Could not save order','The server rejected the section-order change.');});});
	}(jQuery));
	</script>
	<?php
}
add_action( 'admin_footer', 'dkx_section_sorter_admin', 100 );
