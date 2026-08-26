<?php
/**
 * Plugin Name: DK Expressions Visual Layer Manager
 * Description: Adds non-destructive duplicate/delete controls to the DK Visual Page Studio while preserving approved layouts and styling.
 * Version: 1.0.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function dkx_layer_ops( $post_id ) {
    $ops = get_post_meta( absint( $post_id ), '_dkx_visual_layer_ops', true );
    return is_array( $ops ) ? array_values( $ops ) : array();
}

function dkx_layer_clean_path( $path ) {
    $path = substr( trim( (string) $path ), 0, 1000 );
    if ( function_exists( 'dkxv4_visual_sanitize_path' ) ) {
        return dkxv4_visual_sanitize_path( $path );
    }
    return preg_match( '/^[A-Za-z0-9_#.:>+~*()\-\[\]="\'\s]+$/', $path ) ? $path : '';
}

function dkx_layer_ajax() {
    $post_id = isset( $_POST['postId'] ) ? absint( wp_unslash( $_POST['postId'] ) ) : 0;
    check_ajax_referer( 'dkxv4_visual_editor_' . $post_id, 'nonce' );
    if ( ! $post_id || ! current_user_can( 'edit_post', $post_id ) ) {
        wp_send_json_error( array( 'message' => 'You are not allowed to edit this page.' ), 403 );
    }

    $command = sanitize_key( isset( $_POST['command'] ) ? wp_unslash( $_POST['command'] ) : '' );
    $ops = dkx_layer_ops( $post_id );

    if ( 'duplicate' === $command ) {
        $path = dkx_layer_clean_path( isset( $_POST['path'] ) ? wp_unslash( $_POST['path'] ) : '' );
        if ( ! $path ) wp_send_json_error( array( 'message' => 'This layer could not be identified safely.' ), 400 );
        $id = 'clone-' . wp_generate_password( 10, false, false );
        $ops[] = array( 'id' => $id, 'action' => 'clone', 'path' => $path );
        update_post_meta( $post_id, '_dkx_visual_layer_ops', $ops );
        wp_send_json_success( array( 'message' => 'Layer duplicated.', 'op' => end( $ops ), 'ops' => $ops ) );
    }

    if ( 'delete' === $command ) {
        $clone_id = sanitize_key( isset( $_POST['cloneId'] ) ? wp_unslash( $_POST['cloneId'] ) : '' );
        if ( $clone_id ) {
            $ops = array_values( array_filter( $ops, static function( $op ) use ( $clone_id ) {
                return ! ( isset( $op['action'], $op['id'] ) && 'clone' === $op['action'] && $clone_id === $op['id'] );
            } ) );
        } else {
            $path = dkx_layer_clean_path( isset( $_POST['path'] ) ? wp_unslash( $_POST['path'] ) : '' );
            if ( ! $path ) wp_send_json_error( array( 'message' => 'This layer could not be identified safely.' ), 400 );
            $already = false;
            foreach ( $ops as $op ) {
                if ( isset( $op['action'], $op['path'] ) && 'hide' === $op['action'] && $path === $op['path'] ) { $already = true; break; }
            }
            if ( ! $already ) $ops[] = array( 'id' => 'hide-' . wp_generate_password( 10, false, false ), 'action' => 'hide', 'path' => $path );
        }
        if ( $ops ) update_post_meta( $post_id, '_dkx_visual_layer_ops', $ops ); else delete_post_meta( $post_id, '_dkx_visual_layer_ops' );
        wp_send_json_success( array( 'message' => 'Layer removed.', 'ops' => $ops ) );
    }

    if ( 'restore_hidden' === $command ) {
        $ops = array_values( array_filter( $ops, static function( $op ) { return ! isset( $op['action'] ) || 'hide' !== $op['action']; } ) );
        if ( $ops ) update_post_meta( $post_id, '_dkx_visual_layer_ops', $ops ); else delete_post_meta( $post_id, '_dkx_visual_layer_ops' );
        wp_send_json_success( array( 'message' => 'Deleted layers restored.', 'ops' => $ops ) );
    }

    wp_send_json_error( array( 'message' => 'Unknown layer action.' ), 400 );
}
add_action( 'wp_ajax_dkx_visual_layer_action', 'dkx_layer_ajax' );

/** Apply saved duplicate/delete operations before the existing visual override script runs. */
function dkx_layer_canvas_runtime() {
    if ( ! is_singular( array( 'page', 'post' ) ) ) return;
    $post_id = get_queried_object_id();
    if ( ! $post_id ) return;
    $ops = dkx_layer_ops( $post_id );
    $editor = function_exists( 'dkxv4_is_visual_canvas_request' ) && dkxv4_is_visual_canvas_request( $post_id );
    if ( ! $ops && ! $editor ) return;
    ?>
    <script id="dkx-visual-layer-runtime">
    (function(){
      'use strict';
      var cfg={postId:<?php echo (int) $post_id; ?>,editor:<?php echo $editor ? 'true' : 'false'; ?>,ops:<?php echo wp_json_encode( $ops ); ?>};
      function esc(v){if(window.CSS&&CSS.escape)return CSS.escape(v);return String(v).replace(/[^a-zA-Z0-9_-]/g,'\\$&');}
      function path(el){if(!el||el.nodeType!==1)return '';if(el.id&&document.querySelectorAll('#'+esc(el.id)).length===1)return '#'+esc(el.id);var p=[],c=el;while(c&&c.nodeType===1&&c!==document.body){var s=c.tagName.toLowerCase(),par=c.parentElement;if(c.id&&document.querySelectorAll('#'+esc(c.id)).length===1){p.unshift('#'+esc(c.id));break;}if(par){var sib=[].filter.call(par.children,function(x){return x.tagName===c.tagName;});if(sib.length>1)s+=':nth-of-type('+(sib.indexOf(c)+1)+')';}p.unshift(s);if(c.tagName.toLowerCase()==='main')break;c=par;}return p.join(' > ');}
      function stripIds(node){if(!node||node.nodeType!==1)return;node.removeAttribute('id');node.querySelectorAll('[id]').forEach(function(x){x.removeAttribute('id');});}
      function find(p){try{return document.querySelector(p);}catch(e){return null;}}
      function applyOp(op){if(!op||!op.action||!op.path)return;if(op.action==='hide'){var h=find(op.path);if(h){h.setAttribute('data-dkx-layer-hidden','1');h.style.setProperty('display','none','important');}return;}if(op.action==='clone'){if(document.querySelector('[data-dkx-layer-clone-id="'+esc(op.id)+'"]'))return;var src=find(op.path);if(!src)return;var clone=src.cloneNode(true);stripIds(clone);clone.setAttribute('data-dkx-layer-clone-id',op.id);clone.setAttribute('data-dkx-layer-source-path',op.path);var last=src;document.querySelectorAll('[data-dkx-layer-source-path]').forEach(function(x){if(x.getAttribute('data-dkx-layer-source-path')===op.path)last=x;});last.insertAdjacentElement('afterend',clone);}}
      function layerTarget(start){if(!start||!start.closest)return null;var clone=start.closest('[data-dkx-layer-clone-id]');if(clone)return clone;var exact=start.closest('[data-dkx-repeat-item],blockquote,article');if(exact&&exact.closest('main'))return exact;var a=start.closest('a');if(a&&a.closest('main')&&a.parentElement){var d=getComputedStyle(a.parentElement).display;if((d==='grid'||d==='flex')&&a.parentElement.children.length>1)return a;}var cur=start;while(cur&&cur!==document.body&&cur.tagName!=='MAIN'){var par=cur.parentElement;if(par){var display=getComputedStyle(par).display;if((display==='grid'||display==='flex')&&par.children.length>1&&cur.children.length>0)return cur;}cur=par;}var sec=start.closest('section');return sec&&sec.closest('main')?sec:null;}
      function post(m){if(window.parent&&window.parent!==window)window.parent.postMessage(m,window.location.origin);}
      function start(){cfg.ops.forEach(applyOp);if(!cfg.editor)return;document.addEventListener('click',function(e){var layer=layerTarget(e.target);if(!layer)return;setTimeout(function(){var cloneId=layer.getAttribute('data-dkx-layer-clone-id')||'';var source=layer.getAttribute('data-dkx-layer-source-path')||path(layer);post({type:'dkx-layer-info',path:path(layer),sourcePath:source,cloneId:cloneId,label:(layer.tagName.toLowerCase()==='section'?'Section':'Content item'),tag:layer.tagName.toLowerCase()});},0);},true);post({type:'dkx-layer-ready'});}
      window.addEventListener('message',function(e){if(e.origin!==window.location.origin||!e.data||!e.data.type)return;if(e.data.type==='dkx-layer-duplicate-live'){applyOp(e.data.op);}if(e.data.type==='dkx-layer-delete-live'){var n=e.data.cloneId?document.querySelector('[data-dkx-layer-clone-id="'+esc(e.data.cloneId)+'"]'):find(e.data.path);if(n)n.remove();}});
      if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',start);else start();
    }());
    </script>
    <?php
}
add_action( 'wp_footer', 'dkx_layer_canvas_runtime', 1 );

/** Inject layer controls into the existing DK Visual Page Studio inspector. */
function dkx_layer_admin_runtime() {
    if ( ! is_admin() || empty( $_GET['page'] ) || 'dkx-visual-page-editor' !== sanitize_key( wp_unslash( $_GET['page'] ) ) ) return;
    $post_id = isset( $_GET['post'] ) ? absint( wp_unslash( $_GET['post'] ) ) : 0;
    if ( ! $post_id || ! current_user_can( 'edit_post', $post_id ) ) return;
    $ops = dkx_layer_ops( $post_id );
    $hidden = count( array_filter( $ops, static function($op){ return isset($op['action']) && 'hide' === $op['action']; } ) );
    ?>
    <style>
      .dkx-layer-tools{margin-top:16px;padding:15px;border:1px solid #264557;background:#07131c}.dkx-layer-tools__label{display:block;margin-bottom:9px;color:#40b8ff;font-size:10px;font-weight:800;letter-spacing:.14em;text-transform:uppercase}.dkx-layer-tools__actions{display:flex;flex-wrap:wrap;gap:8px}.dkx-layer-tools .button.is-danger{border-color:#ff5364;color:#ff5364}.dkx-layer-restore{margin-top:14px;padding-top:12px;border-top:1px solid #173342}.dkx-layer-note{margin:8px 0 0;color:#9db2c2;font-size:12px;line-height:1.45}
    </style>
    <script>
    (function($){
      'use strict';
      var root=document.querySelector('[data-dkx-visual-studio]');if(!root)return;
      var panel=root.querySelector('[data-dkx-selection]'),frame=root.querySelector('#dkx-visual-canvas'),status=root.querySelector('[data-dkx-status]');var layer=null;
      var ajax=<?php echo wp_json_encode( admin_url( 'admin-ajax.php' ) ); ?>,postId=<?php echo (int) $post_id; ?>,nonce=<?php echo wp_json_encode( wp_create_nonce( 'dkxv4_visual_editor_' . $post_id ) ); ?>;
      function statusSet(state,title,copy){if(!status)return;status.setAttribute('data-state',state);status.querySelector('strong').textContent=title;status.querySelector('span').textContent=copy;}
      function send(m){if(frame&&frame.contentWindow)frame.contentWindow.postMessage(m,window.location.origin);}
      function tools(){var old=root.querySelector('.dkx-layer-tools');if(old)old.remove();if(!panel||panel.hidden||!layer)return;var box=document.createElement('div');box.className='dkx-layer-tools';box.innerHTML='<span class="dkx-layer-tools__label">Layer / content controls</span><div class="dkx-layer-tools__actions"><button type="button" class="button button-primary" data-dkx-layer-duplicate>Duplicate this '+(layer.tag==='section'?'section':'item')+'</button><button type="button" class="button is-danger" data-dkx-layer-delete>Delete this '+(layer.tag==='section'?'section':'item')+'</button></div><p class="dkx-layer-note">Duplicate keeps the exact DK layout, classes, spacing and colour system. Edit only the new content after duplicating.</p>';var actions=panel.querySelector('.dkx-vps__selection-actions');if(actions)actions.insertAdjacentElement('afterend',box);else panel.appendChild(box);}
      function act(command){if(!layer)return;if(command==='delete'&&!window.confirm('Remove this '+(layer.tag==='section'?'section':'content item')+' from the page? The approved styling elsewhere will not change.'))return;statusSet('saving',command==='duplicate'?'Duplicating layer':'Removing layer','Saving the structural change without altering the DK design.');$.post(ajax,{action:'dkx_visual_layer_action',nonce:nonce,postId:postId,command:command,path:command==='duplicate'?layer.sourcePath:layer.path,cloneId:layer.cloneId||''},null,'json').done(function(r){if(!r||!r.success){statusSet('error','Layer change failed',r&&r.data&&r.data.message?r.data.message:'WordPress could not save this layer change.');return;}if(command==='duplicate'){send({type:'dkx-layer-duplicate-live',op:r.data.op});statusSet('saved','Layer duplicated','The new item uses the exact same layout and styling. Click its text or media to replace the content.');}else{send({type:'dkx-layer-delete-live',path:layer.path,cloneId:layer.cloneId||''});statusSet('saved','Layer removed','The item has been removed without changing the surrounding layout.');layer=null;tools();}}).fail(function(){statusSet('error','Layer change failed','The server rejected the structural change.');});}
      window.addEventListener('message',function(e){if(e.origin!==window.location.origin||!e.data)return;if(e.data.type==='dkx-layer-info'){layer=e.data;setTimeout(tools,0);}});
      root.addEventListener('click',function(e){if(e.target.closest('[data-dkx-layer-duplicate]')){act('duplicate');return;}if(e.target.closest('[data-dkx-layer-delete]')){act('delete');return;}if(e.target.closest('[data-dkx-layer-restore]')){$.post(ajax,{action:'dkx_visual_layer_action',nonce:nonce,postId:postId,command:'restore_hidden'},null,'json').done(function(r){if(r&&r.success){statusSet('saved','Deleted layers restored','Refresh the canvas to see restored sections and items.');frame.src=frame.src+(frame.src.indexOf('?')===-1?'?':'&')+'dkx_restore='+Date.now();var b=root.querySelector('[data-dkx-layer-restore]');if(b)b.closest('.dkx-layer-restore').remove();}});}});
      var inspector=root.querySelector('.dkx-vps__inspector');if(inspector&&<?php echo (int) $hidden; ?>>0){var restore=document.createElement('section');restore.className='dkx-layer-restore';restore.innerHTML='<button type="button" class="button" data-dkx-layer-restore>Restore deleted layers (<?php echo (int) $hidden; ?>)</button>';inspector.appendChild(restore);}
    }(jQuery));
    </script>
    <?php
}
add_action( 'admin_footer', 'dkx_layer_admin_runtime', 99 );
