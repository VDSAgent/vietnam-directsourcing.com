<?php 
class wb_wp_ajaxs
{
    public function __construct()
    {
        $actions = [
            'wb_load_blog'=>'public'
        ];
        foreach($actions as $action=>$security){
            add_action( "wp_ajax_{$action}", [$this,'calback_'.$action]);
            if($security == 'public'){
                add_action( "wp_ajax_nopriv_{$action}", [$this,'calback_'.$action]);
            }
        }
    }
    public function calback_wb_load_blog()
    {
        extract($_REQUEST);

       
        $args = isset($_POST['data'])?$_POST['data']:false;
        if($args):
            if(isset($args['paged'])){
            $args['paged'] = $args['paged'] + 1;
            }
        
        switch($args['post_type']){
            case 'podcast':
                $temp = 'loop/podcast';                
                break;            
        }
        
        $loop = new WP_Query($args);
        ob_start();
        if($loop->have_posts()):            
            ?>
            
                <?php while($loop->have_posts()):$loop->the_post()?>
                <?php get_template_part($temp,'null')?>
                <?php endwhile?>
            <?php            
        else:
            ?>
            <div class="no-posts align-center">
                <?php _e('No post found.')?>
            </div>
            <?php 
        endif;
        $more = $loop->max_num_pages > $args['paged']?true:false;
        $html = ob_get_clean();
        $returns = [
            'items' => $html,
            'more' => $more,
            'args'  => $args
        ];        
        wp_send_json($returns);
        endif;
        wp_die();
    }
}
new wb_wp_ajaxs;