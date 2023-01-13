<?php


namespace greenshift\Blocks;
defined('ABSPATH') OR exit;


class SocialShare{

	public function __construct(){
		add_action('init', array( $this, 'init_handler' ));
	}

	public function init_handler(){
		register_block_type(__DIR__, array(
                'render_callback' => array( $this, 'render_block' ),
                'attributes'      => $this->attributes
            )
		);
	}

	public $attributes = array(
		'id' => array(
			'type'    => 'string',
			'default' => null,
		),
		'inlineCssStyles' => array(
			'type'    => 'string',
			'default' => '',
		),
		'animation' => array(
			'type' => 'object',
			'default' => array(),
		),
        'socialLabelsDef' => array(
            'type' => 'array',
            'default' => array(
                'fb' => 'Share on Facebook',
                'tw' => 'Share on Twitter',
                'tg' => 'Share on Telegram',
                'pn' => 'Share on Pinterest',
                'wa' => 'Share on Whatsapp',
                'in' => 'Share on Linkedin',
                'email' => 'Share on Email',
            )
        ),
        'queryString' => array(
            'type' => 'string',
            'default' => ''
        )
	);

	public function render_block($settings = array(), $inner_content=''){
		extract($settings);
        global $post;
        
        if(!empty($socialLabels)) $socialLabelsDef = $socialLabels;

        $social_share = self::get_social_share($post, $socialLabelsDef, $queryString);

		$blockId = 'gspb_id-'.$id;
		$blockClassName = 'gspb-social-sharebox '.$blockId.' '.(!empty($className) ? $className : '').' ';

		$out = '<div id="'.$blockId.'" class="'.$blockClassName.'"'.gspb_AnimationRenderProps($animation).'>';
            $out .= '<span>' . $social_share . '</span>';
		$out .='</div>';
		return $out;
	}

    static function get_social_share($_post, $socialLabelsDef, $queryString) {
        $link = get_permalink($_post->ID);
        if($queryString){
            $link = $link.'?wishlistids='.$queryString;
        }
        $title = $_post->post_title;
        $image = wp_get_attachment_url( get_post_thumbnail_id($_post->ID) );
        $res = '<span class="gspb_social_share_value icons_with_bg_labels">';

        // facebook
        $res .= '<span title="Facebook" data-href="https://www.facebook.com/sharer/sharer.php?u='.urlencode($link).'" class="fb gs-share-link" data-service="facebook"><span class="social-share-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 333333 333333" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"><path d="M197917 62502h52080V0h-52080c-40201 0-72909 32709-72909 72909v31250H83337v62507h41659v166667h62506V166666h52080l10415-62506h-62496V72910c0-5648 4768-10415 10415-10415v6z" fill="#3b5998"/></svg></span><span class="social-share-label"><span>' . $socialLabelsDef['fb'] .'</span><span class="dark-bg"></span></span></span>';

        // twitter
        $res .= '<span title="Twitter" data-href="https://twitter.com/share?url='.urlencode($link).'&text='.urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')).'" class="tw gs-share-link" data-service="twitter"><span class="social-share-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 333333 333333" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"><path d="M333328 63295c-12254 5480-25456 9122-39241 10745 14123-8458 24924-21861 30080-37819-13200 7807-27871 13533-43416 16596-12499-13281-30252-21537-49919-21537-37762 0-68336 30591-68336 68330 0 5326 591 10537 1748 15562-56820-2880-107194-30081-140915-71467-6049 10435-9250 22300-9250 34367v8c0 23696 12031 44654 30389 56876-11202-333-21739-3457-30991-8519v854c0 33138 23554 60789 54852 67039-5734 1557-11787 2417-18023 2417-4417 0-8673-455-12905-1224 8742 27139 33975 46923 63857 47500-23430 18356-52858 29286-84939 29286-5537 0-10931-339-16318-984 30326 19458 66251 30727 104844 30727 125735 0 194551-104198 194551-194543 0-3002-67-5911-191-8852 13354-9553 24932-21609 34097-35333l31-31-6 4z" fill="#1da1f2"/></svg></span><span class="social-share-label"><span>' . $socialLabelsDef['tw'] .'</span><span class="dark-bg"></span></span></span>';

//        if($image) {
            // pinterest
        $res .= '<span title="Pinterest" data-href="https://pinterest.com/pin/create/button/?url='.urlencode($link).'&amp;media='.urlencode($image).'&amp;description='.urlencode($title).'" class="pn gs-share-link" data-service="pinterest"><span class="social-share-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 333333 333333" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"><path d="M94403 333233c18491-16492 31185-39980 37381-64068 2499-9495 12694-48376 12694-48376 6597 12694 26087 23389 46577 23389 61369 0 105547-56372 105547-126637C296602 50275 241730 0 171165 0 83309 0 36733 58970 36733 123138c0 29785 15892 66967 41279 78761 3798 1899 5897 1000 6797-2799 600-2898 4098-16591 5697-23088 500-1999 300-3898-1399-5897-8396-10195-15192-28985-15192-46377 0-44878 33983-88356 91854-88356 49975 0 84957 33983 84957 82759 0 55072-27786 93254-63968 93254-19990 0-34982-16492-30085-36781 5797-24188 16891-50275 16891-67666 0-15592-8296-28585-25787-28585-20490 0-36781 21089-36781 49475 0 17991 5997 30185 5997 30185s-20190 85257-23888 101150c-4098 17591-2499 42279-700 58371l1799 15792 200-101z" fill="#bd081c"/></svg></span><span class="social-share-label"><span>' . $socialLabelsDef['pn'] .'</span><span class="dark-bg"></span></span></span>';
//        }

        // whatsapp
        $res .= '<span title="whatsapp" data-href="whatsapp://send?&text='.urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')).' - '.urlencode($link).'" data-action="share/whatsapp/share" class="wa gs-share-link" data-service="whatsapp"><span class="social-share-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 241.19"><path d="M205,35.05A118.61,118.61,0,0,0,120.46,0C54.6,0,1,53.61,1,119.51a119.5,119.5,0,0,0,16,59.74L0,241.19l63.36-16.63a119.43,119.43,0,0,0,57.08,14.57h0A119.54,119.54,0,0,0,205,35.07v0ZM120.5,219A99.18,99.18,0,0,1,69.91,205.1l-3.64-2.17-37.6,9.85,10-36.65-2.35-3.76A99.37,99.37,0,0,1,190.79,49.27,99.43,99.43,0,0,1,120.49,219ZM175,144.54c-3-1.51-17.67-8.71-20.39-9.71s-4.72-1.51-6.75,1.51-7.72,9.71-9.46,11.72-3.49,2.27-6.45.76-12.63-4.66-24-14.84A91.1,91.1,0,0,1,91.25,113.3c-1.75-3-.19-4.61,1.33-6.07s3-3.48,4.47-5.23a19.65,19.65,0,0,0,3-5,5.51,5.51,0,0,0-.24-5.23C99,90.27,93,75.57,90.6,69.58s-4.89-5-6.73-5.14-3.73-.09-5.7-.09a11,11,0,0,0-8,3.73C67.48,71.05,59.75,78.3,59.75,93s10.69,28.88,12.19,30.9S93,156.07,123,169c7.12,3.06,12.68,4.9,17,6.32a41.18,41.18,0,0,0,18.8,1.17c5.74-.84,17.66-7.21,20.17-14.18s2.5-13,1.75-14.19-2.69-2.06-5.7-3.59l0,0Z"/></svg></span><span class="social-share-label"><span>' . $socialLabelsDef['wa'] .'</span><span class="dark-bg"></span></span></span>';

        // linkedin
        $res .= '<span title="Linkedin" data-href="https://www.linkedin.com/shareArticle?mini=true&url='.urlencode($link).'&title='.urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')).'&source='.urlencode(html_entity_decode(get_bloginfo("name"), ENT_COMPAT, 'UTF-8')).'" class="in gs-share-link" data-service="linkedin"><span class="social-share-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 333333 333333" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"><path d="M119066 107135h65865v33765l952 2c9173-16456 31602-33765 65046-33765 69550-2 82413 43280 82413 99584v114694l-68689 2V219745c0-24237-504-55437-35716-55437-35765 0-41245 26383-41245 53672v103438h-68626V107137zM71447 47613c0 19716-16000 35715-35716 35715S9 67328 9 47613c0-19716 16006-35716 35722-35716s35716 16000 35716 35716zM9 107135h71438v214281H9V107135z" fill="#0077b5"/></svg></span><span class="social-share-label"><span>' . $socialLabelsDef['in'] .'</span><span class="dark-bg"></span></span></span>';
{       // tg
        $res .= '<span title="Telegram" data-href="https://t.me/share/url?url='.urlencode($link).'&text='.urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')).'" class="tg gs-share-link" data-service="telegram"><span class="social-share-icon"><svg version="1.1" viewBox="0 0 512 512"><path d="M484.689,98.231l-69.417,327.37c-5.237,23.105-18.895,28.854-38.304,17.972L271.2,365.631     l-51.034,49.086c-5.646,5.647-10.371,10.372-21.256,10.372l7.598-107.722L402.539,140.23c8.523-7.598-1.848-11.809-13.247-4.21     L146.95,288.614L42.619,255.96c-22.694-7.086-23.104-22.695,4.723-33.579L455.423,65.166     C474.316,58.081,490.85,69.375,484.689,98.231z"/></svg></span><span class="social-share-label"><span>' . $socialLabelsDef['tg'] .'</span><span class="dark-bg"></span></span></span>';}
        // mail
        $res .= '<span title="Mail" data-href="mailto:?subject='.urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')).'&body='.__('Check out:', 'greenshift-animation-and-page-builder-blocks').' '.urlencode($link).' - '.urlencode(html_entity_decode(get_bloginfo("name"), ENT_COMPAT, 'UTF-8')).'" class="email gs-share-link" data-service="email"><span class="social-share-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 88.86"><path d="M7.05,0H115.83a7.07,7.07,0,0,1,7,7.05V81.81a7,7,0,0,1-1.22,4,2.78,2.78,0,0,1-.66,1,2.62,2.62,0,0,1-.66.46,7,7,0,0,1-4.51,1.65H7.05a7.07,7.07,0,0,1-7-7V7.05A7.07,7.07,0,0,1,7.05,0Zm-.3,78.84L43.53,40.62,6.75,9.54v69.3ZM49.07,45.39,9.77,83.45h103L75.22,45.39l-11,9.21h0a2.7,2.7,0,0,1-3.45,0L49.07,45.39Zm31.6-4.84,35.46,38.6V9.2L80.67,40.55ZM10.21,5.41,62.39,47.7,112.27,5.41Z"/></svg></span><span class="social-share-label"><span>' . $socialLabelsDef['email'] .'</span><span class="dark-bg"></span></span></span>';

        $res .= '</span>';
        return $res;
    }
}

new SocialShare;