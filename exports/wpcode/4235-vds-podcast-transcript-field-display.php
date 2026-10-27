// VDS: transcript field for podcast episodes + collapsed "Read the full transcript" on the episode page.
// Format inside the field: plain text, a line starting "## " is a subheading, a blank line separates paragraphs.

add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;
    acf_add_local_field_group(array(
        'key'      => 'group_vds_transcript',
        'title'    => 'Episode transcript',
        'fields'   => array(array(
            'key'          => 'field_vds_transcript',
            'label'        => 'Transcript',
            'name'         => 'vds_transcript',
            'type'         => 'textarea',
            'rows'         => 20,
            'new_lines'    => '',
            'instructions' => 'Plain text. Start a line with "## " for a subheading. Separate paragraphs with a blank line.',
        )),
        'location' => array(array(array('param' => 'post_type', 'operator' => '==', 'value' => 'podcast'))),
        'position' => 'normal',
    ));
});

add_filter('the_content', function ($content) {
    if (!is_singular('podcast') || !in_the_loop() || !is_main_query() || !function_exists('get_field')) return $content;
    $raw = trim((string) get_field('vds_transcript', get_the_ID(), false));
    if ($raw === '') return $content;
    $html = '';
    foreach (preg_split('/\R{2,}/', $raw) as $block) {
        $block = trim($block);
        if ($block === '') continue;
        $html .= strpos($block, '## ') === 0 ? '<h3 style="margin:28px 0 12px;">' . esc_html(substr($block, 3)) . '</h3>' : '<p style="margin:0 0 14px;line-height:1.7;">' . esc_html($block) . '</p>';
    }
    return $content
        . '<details class="vds-transcript" style="margin:24px 0;"><summary style="cursor:pointer;font-weight:700;">Read the full transcript</summary>'
        . '<p><em>This episode is AI-generated audio. The transcript has been lightly edited for readability.</em></p>'
        . $html . '</details>';
}, 25);
