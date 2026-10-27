jQuery(document).ready(function($) {
    let paged = 2; // Start with the second page
    const postsPerPage = loadMoreParams.postsPerPage;
    $('#load-more').on('click', function(e) {
        e.preventDefault();

        $.ajax({
            url: loadMoreParams.ajaxUrl,
            type: 'POST',
            data: {
                action: 'load_more_posts_new',
                paged: paged,
                postsPerPage: postsPerPage,
            },
            success: function(response) {
                if (response.trim() === 'no more posts') {
                    $('#load-more').hide();
                } else {
                    $('#posts-container').append(response);
                    paged++;
                }
            },
        });
    });
});
