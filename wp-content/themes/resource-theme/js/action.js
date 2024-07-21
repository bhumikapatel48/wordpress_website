jQuery(document).ready(function($) {
    var page = 1; // Initialize page counter
    var filters = {}; // Initialize filters object

    // Function to load posts based on selected filters or load more
    function loadPosts(action) {
        // Reset filters object when reloading posts
        if (action === 'load_filtered_posts') {
            filters = {}; // Clear filters object when applying new filters
            $('.filter-checkbox:checked').each(function() {
                var taxonomy = $(this).data('taxonomy'); // Get taxonomy name from data attribute
                if (!filters[taxonomy]) {
                    filters[taxonomy] = [];
                }
                filters[taxonomy].push($(this).val());
            });
        }

        var searchQuery = $('#search-input').val(); // Get the value of the search input
        console.log(searchQuery);
        var data = {
            action: 'load_filtered_posts',
            nonce: resource_theme_action_object.nonce,
            page: action === 'load_more_posts' ? page + 1 : 1,
            filters: filters,
            s: searchQuery // Include search query in data object
        };

        $.post(resource_theme_action_object.ajaxurl, data, function(response) {
            if (action === 'load_more_posts') {
                if (response.trim() !== '') {
                    $('#resource-container').append(response); // Append more posts
                    page++; // Increment page counter after successful load more
                } else {
                    $('#load-more-button').hide(); // Hide load more button if no more posts
                }
            } else {
                $('#resource-container').html(response); // Replace current content with filtered posts
                page = 1; // Reset page counter after applying filters

                // Show or hide load more button based on response
                if (response.trim() === '') {
                    $('#load-more-button').hide();
                } else {
                    $('#load-more-button').show();
                }
            }
        });
    }

    // Initial load on page load
    loadPosts('load_filtered_posts');

    // Filter posts on checkbox change
    $('.filter-checkbox').on('change', function() {
        loadPosts('load_filtered_posts'); // Reload posts based on updated filters
    });

    // Load more button functionality
    $('#load-more-button').on('click', function(e) {
        e.preventDefault();
        loadPosts('load_more_posts'); // Load more posts
    });

    // Search functionality
    $('#search-form').on('submit', function(e) {
        e.preventDefault();
        loadPosts('load_filtered_posts'); // Reload posts based on submitted search query
    });
    $('#reset-filters').on('click', function() {
        $('.filter-checkbox:checked').prop('checked', false); // Uncheck all checkboxes
        $('#search-input').val(''); // Clear search input
        filters = {}; // Clear filters object
        loadPosts('load_filtered_posts'); // Reload posts with cleared filters
    });
});
