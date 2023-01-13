<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

?>
<table class="form-table font-item">
  <thead>
    <tr>
      <th colspan="2">
        <?php esc_html_e("Font", 'greenshift-animation-and-page-builder-blocks') . ' #' . $i; ?>
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="label-td">
        <label for="font_family_name_<?php echo esc_attr($i)?>">
          <?php esc_html_e("Font Family Name", 'greenshift-animation-and-page-builder-blocks'); ?>
        </label>
      </td>
      <td>
        <input name="font_family_name[]" id="font_family_name_<?php echo esc_attr($i)?>" type="text" value="<?php echo !empty($name) ? esc_attr($name) : ''?>" placeholder="Raleway" required/>
        <div class="input-desc">
          <?php esc_html_e("Make sure that name has only Latin symbols without numbers and special characters", 'greenshift-animation-and-page-builder-blocks'); ?>
        </div>
      </td>
    </tr>
    <?php foreach ($allowed_font_ext as $ext):?>
      <tr>
        <td class="label-td">
          <label for="font_<?php echo esc_attr($ext)?>_file_<?php echo $i?>">
            <?php echo '.' . $ext . ' ' . esc_html__("Font file", 'greenshift-animation-and-page-builder-blocks'); ?>
          </label>
        </td>
        <td>
          <input
              name="font_<?php echo esc_attr($ext)?>_file[]"
              id="font_<?php echo esc_attr($ext)?>_file_<?php echo esc_attr($i)?>"
              type="file"
              accept=".<?php echo esc_attr($ext)?>"
          />
          <input class="current-file-hidden-input" type="hidden" name="<?php echo esc_attr($ext)?>[]" value="<?php echo !empty($options[$ext]) ? $options[$ext] : ''?>">
          <div class="input-desc">
            <?php echo sprintf(__("Upload .%s font file", 'greenshift-animation-and-page-builder-blocks'), $ext); ?>
          </div>
          <?php if(!empty($options[$ext])):?>
            <div class="current-file" style="margin-top: 5px;">
              <?php esc_html_e('Current file', 'greenshift-animation-and-page-builder-blocks')?>: <b><?php echo basename($options[$ext])?></b>

              <div class="current-file-actions">
                (<a href="<?php echo esc_url($options[$ext])?>"><?php esc_html_e('Download', 'greenshift-animation-and-page-builder-blocks')?></a>
                /
                <a href="#" class="remove-font-file"><?php esc_html_e('Remove', 'greenshift-animation-and-page-builder-blocks')?></a>)
              </div>
            </div>
          <?php endif;?>
        </td>
      </tr>
    <?php endforeach;?>
  </tbody>
</table>