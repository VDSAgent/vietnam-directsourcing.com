// Restrict the Articles page "Load More" AJAX handler (load_more_posts_new) to published
// posts only. Without this, its WP_Query has no post_status restriction, so it also matches
// draft and scheduled posts, which shifts its own pagination boundaries out of sync with the
// page's initial (published-only) query -- causing Load More to briefly repeat posts at each
// page boundary. Scoped tightly: only affects queries made during that one AJAX action.
add_action('pre_get_posts', function ($query) {
    if (isset($_POST['action']) && $_POST['action'] === 'load_more_posts_new') {
        $query->set('post_status', 'publish');
    }
});