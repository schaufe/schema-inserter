<?php
/*

Plugin Name: Schema Inserter
Plugin URI:
Description: Provides a button in the editor for inserting Schema.org microdata without the requirement of coding.
Version:
Author: lschaufe
Author URI:
License: GPL v2

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA


	Resources

	http://www.google.com/webmasters/tools/richsnippets
	http://foolip.org/microdatajs/live/
*/

if(!defined('SC_BASE'))
	define('SC_BASE', plugin_basename(__FILE__) );

if(!defined('SC_VER'))
	define('SC_VER', '1.042');


if ( !class_exists( "SchemaInserter" ) ) :
	class SchemaInserter
	{
		/**
		 * Constructs a new SchemaInserter
		 */
		public function __construct() {

			add_action( 'plugins_loaded', array( $this, 'plugin_textdomain' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );

			add_shortcode( 'type_person', array( $this, 'type_person_gen' ) );
			add_shortcode( 'type_event', array( $this, 'type_event_gen' ) );
			add_shortcode( 'type_org', array( $this, 'type_org_gen' ) );
			add_shortcode( 'type_movie', array( $this, 'type_movie_gen' ) );
			add_shortcode( 'type_book', array( $this, 'type_book_gen' ) );
			add_shortcode( 'type_review', array( $this, 'type_review_gen' ) );
			add_shortcode( 'type_bevent', array( $this, 'type_bevent_gen' ) );
			add_shortcode( 'type_slevent', array( $this, 'type_slevent_gen' ) );
			add_shortcode( 'type_sclevent', array( $this, 'type_sclevent_gen' ) );
			add_shortcode( 'type_corp', array( $this, 'type_corp_gen' ) );
			add_shortcode( 'type_lbus', array( $this, 'type_lbus_gen' ) );
			add_shortcode( 'type_rating', array( $this, 'type_rating_gen' ) );
			add_shortcode( 'type_tvseries', array( $this, 'type_tvseries_gen' ) );
			add_shortcode( 'type_bpost', array( $this, 'type_bpost_gen' ) );
			add_shortcode( 'type_article', array( $this, 'type_article_gen' ) );
			add_shortcode( 'type_techartcl', array( $this, 'type_techartcl_gen' ) );
			add_shortcode( 'type_vidobj', array( $this, 'type_vidobj_gen' ) );
			add_shortcode( 'type_podobj', array( $this, 'type_podobj_gen' ) );
			add_shortcode( 'type_itemlist', array( $this, 'type_itemlist_gen' ) );
			add_shortcode( 'type_wbnobj', array( $this, 'type_wbnobj_gen' ) );
			add_shortcode( 'type_brand', array($this, 'type_brand_gen'));
			add_shortcode( 'type_offer', array($this, 'type_offer_gen'));
			add_shortcode( 'type_place', array($this, 'type_place_gen'));
			add_shortcode( 'type_postaladdr', array($this, 'type_postaladdr_gen'));
			add_shortcode( 'type_jobpstng', array($this, 'type_jobpstng_gen'));
			add_shortcode( 'type_imgobj', array($this, 'type_imgobj_gen'));
			add_shortcode( 'type_mediaobj', array($this, 'type_mediaobj_gen'));
			add_shortcode( 'type_thing', array($this, 'type_thing_gen'));

			add_shortcode( 'prop_name', array( $this, 'prop_name_gen' ) );
			add_shortcode( 'prop_affil', array( $this, 'prop_affil_gen' ) );
			add_shortcode( 'prop_url', array( $this, 'prop_url_gen' ) );
			add_shortcode( 'prop_loc', array( $this, 'prop_loc_gen' ) );
			add_shortcode( 'prop_sdate', array( $this, 'prop_sdate_gen' ) );
			add_shortcode( 'prop_addr', array( $this, 'prop_addr_gen' ) );
			add_shortcode( 'prop_aloc', array( $this, 'prop_aloc_gen' ) );
			add_shortcode( 'prop_areg', array( $this, 'prop_areg_gen' ) );
			add_shortcode( 'prop_auth', array( $this, 'prop_auth_gen' ) );
			add_shortcode( 'prop_desc', array( $this, 'prop_desc_gen' ) );
			add_shortcode( 'prop_pub', array( $this, 'prop_pub_gen' ) );
			add_shortcode( 'prop_dir', array( $this, 'prop_dir_gen' ) );
			add_shortcode( 'prop_img', array( $this, 'prop_img_gen' ) );
			add_shortcode( 'prop_job', array( $this, 'prop_job_gen' ) );
			add_shortcode( 'prop_bdate', array( $this, 'prop_bdate_gen' ) );
			add_shortcode( 'prop_street', array( $this, 'prop_street_gen' ) );
			add_shortcode( 'prop_zip', array( $this, 'prop_zip_gen' ) );
			add_shortcode( 'prop_email', array( $this, 'prop_email_gen' ) );
			add_shortcode( 'prop_acntry', array( $this, 'prop_acntry_gen' ) );
			add_shortcode( 'prop_edate', array( $this, 'prop_edate_gen' ) );
			add_shortcode( 'prop_itmrv', array( $this, 'prop_itmrv_gen' ) );
			add_shortcode( 'prop_rrating', array( $this, 'prop_rrating_gen' ) );
			add_shortcode( 'prop_rval', array( $this, 'prop_rval_gen' ) );
			add_shortcode( 'prop_sameas', array( $this, 'prop_sameas_gen' ) );
			add_shortcode( 'prop_video', array( $this, 'prop_video_gen' ) );
			add_shortcode( 'prop_podcast', array( $this, 'prop_podcast_gen' ) );
			add_shortcode( 'prop_itmle', array( $this, 'prop_itmle_gen' ) );
			add_shortcode( 'prop_itmlo', array( $this, 'prop_itmlo_gen' ) );
			add_shortcode( 'prop_webinar', array( $this, 'prop_webinar_gen' ) );
			add_shortcode( 'prop_brand', array( $this, 'prop_brand_gen' ) );
			add_shortcode( 'prop_mkffr', array( $this, 'prop_mkffr_gen' ) );
			add_shortcode( 'prop_dateposted', array( $this, 'prop_dateposted_gen' ) );
			add_shortcode( 'prop_expreqs', array( $this, 'prop_expreqs_gen' ) );
			add_shortcode( 'prop_hrngorg', array( $this, 'prop_hrngorg_gen' ) );
			add_shortcode( 'prop_bnfts', array( $this, 'prop_bnfts_gen' ) );
			add_shortcode( 'prop_incnts', array( $this, 'prop_incnts_gen' ) );
			add_shortcode( 'prop_ind', array( $this, 'prop_ind_gen' ) );
			add_shortcode( 'prop_jobloc', array( $this, 'prop_jobloc_gen' ) );
			add_shortcode( 'prop_attnd', array( $this, 'prop_attnd_gen' ) );
			add_shortcode( 'prop_logo', array( $this, 'prop_logo_gen' ) );
			add_shortcode( 'prop_offers', array( $this, 'prop_offers_gen' ) );
			add_shortcode( 'prop_prfrmr', array( $this, 'prop_prfrmr_gen' ) );
			add_shortcode( 'prop_wrksfr', array( $this, 'prop_wrksfr_gen' ) );

			add_shortcode( 'rendertool', array( $this, 'rendertool_gen' ) );
		}

		/*************/
		// itemtypes
		/*************/

		/** Build out person shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function type_person_gen($atts, $content = null ){
			$html = '<span itemscope itemtype="http://schema.org/Person">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out event shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function type_event_gen($atts, $content = null ){
			$html = '<span itemscope itemtype="http://schema.org/Event">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out organization shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function type_org_gen($atts, $content = null ){
			$html = '<span itemscope itemtype="http://schema.org/Organization">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out movie shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function type_movie_gen($atts, $content = null ){
			$html = '<span itemscope itemtype="http://schema.org/Movie">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out book shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function type_book_gen($atts, $content = null ){
			$html = '<span itemscope itemtype="http://schema.org/Book">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out review shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function type_review_gen($atts, $content = null ){
			$html = '<span itemscope itemtype="http://schema.org/Review">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out BusinessEvent shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function type_bevent_gen($atts, $content = null ){
			$html = '<span itemscope itemtype="http://schema.org/BusinessEvent">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out SaleEvent shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function type_slevent_gen($atts, $content = null ){
			$html = '<span itemscope itemtype="http://schema.org/SaleEvent">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out SocialEvent shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function type_sclevent_gen($atts, $content = null ){
			$html = '<span itemscope itemtype="http://schema.org/SocialEvent">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out Corporation shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function type_corp_gen($atts, $content = null ){
			$html = '<span itemscope itemtype="http://schema.org/Corporation">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out LocalBusiness shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function type_lbus_gen($atts, $content = null ){
			$html = '<span itemscope itemtype="http://schema.org/LocalBusiness">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out Rating shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function type_tvseries_gen($atts, $content = null ){
			$html = '<span itemscope itemtype="http://schema.org/TVSeries">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out TVSeries shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function type_rating_gen($atts, $content = null ){
			$html = '<span itemscope itemtype="http://schema.org/Rating">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out BlogPosting shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function type_bpost_gen($atts, $content = null){
			$html = '<span itemscope itemtype="http://schema.org/BlogPosting">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out Article shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function type_article_gen($atts, $content = null){
			$html = '<span itemscope itemtype="http://schema.org/Article">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out TechArticle shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function type_techartcl_gen($atts, $content = null){
			$html = '<span itemscope itemtype="http://schema.org/TechArticle">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out VideoObject shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function type_vidobj_gen($atts, $content = null){
			$html = '<span itemscope itemtype="http://schema.org/VideoObject">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out PodcastObject shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function type_podobj_gen($atts, $content = null){
			$html = '<span itemscope itemtype="http://schema.org/AudioObject http://schema.org/AudioObject/PodcastObject">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out ItemList shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function type_itemlist_gen($atts, $content = null){
			$html = '<span itemscope itemtype="http://schema.org/ItemList">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out WebinarObject shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function type_wbnobj_gen($atts, $content = null){
			$html = '<span itemscope itemtype="http://schema.org/MediaObject http://schema.org/MediaObject/WebinarObject">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out Brand shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function type_brand_gen($atts, $content = null){
			$html = '<span itemscope itemtype="http://schema.org/Brand">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out Offer shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function type_offer_gen($atts, $content = null){
			$html = '<span itemscope itemtype="http://schema.org/Offer">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out Place shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function type_place_gen($atts, $content = null){
			$html = '<span itemscope itemtype="http://schema.org/Place">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out PostalAddress shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function type_postaladdr_gen($atts, $content = null){
			$html = '<span itemscope itemtype="http://schema.org/PostalAddress">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out JobPosting shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function type_jobpstng_gen($atts, $content = null){
			$html = '<span itemscope itemtype="http://schema.org/JobPosting">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out ImageObject shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function type_imgobj_gen($atts, $content = null){
			$html = '<span itemscope itemtype="http://schema.org/ImageObject">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out MediaObject shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function type_mediaobj_gen($atts, $content = null){
			$html = '<span itemscope itemtype="http://schema.org/MediaObject">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/** Build out Thing shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function type_thing_gen($atts, $content = null){
			$html = '<span itemscope itemtype="http://schema.org/Thing">';
			$html .= do_shortcode($content);
			$html .= '</span>';
			return $html;
		}

		/*************/
		// itemprops
		/*************/

		/** Build out name shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function prop_name_gen($atts, $content = null){
			$html = '<span itemprop="name">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out affiliation shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function prop_affil_gen($atts, $content = null){
			$html = '<span itemprop="affiliation">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out url shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function prop_url_gen($atts, $content = null){
			extract( shortcode_atts( array(
				'url' => '',
				'target' => '',
			), $atts ) );
			if (isset($target) && $target == 'Blank'){
				$html = '<a itemprop="url" href="'.$url.'" target="_blank">'.do_shortcode($content).'</a>';
			}
			else $html = '<a itemprop="url" href="'.$url.'">'.do_shortcode($content).'</a>';
			return $html;
		}

		/** Build out location shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function prop_loc_gen($atts, $content = null){
			extract( shortcode_atts( array(
				'type' => '',
			), $atts ) );
			if (isset($type) && $type == 'Place'){
				$html = '<span itemprop="location" itemscope itemtype="http://schema.org/Place">'.do_shortcode($content).'</span>';
			}
			else $html = '<span itemprop="location">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out startDate shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function prop_sdate_gen($atts, $content = null){
			extract( shortcode_atts( array(
				'cntnt' => '',
			), $atts ) );
			$html = '<meta itemprop="startDate" content="'.$cntnt.'">';
			return $html;
		}

		/** Build out endDate shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function prop_edate_gen($atts, $content = null){
			extract( shortcode_atts( array(
				'cntnt' => '',
			), $atts ) );
			$html = '<meta itemprop="endDate" content="'.$cntnt.'">';
			return $html;
		}

		/** Build out address shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function prop_addr_gen($atts, $content = null){
			extract( shortcode_atts( array(
				'type' => '',
			), $atts ) );
			if (isset($type) && $type == 'PostalAddress'){
				$html = '<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">'.do_shortcode($content).'</span>';
			}
			else $html = '<span itemprop="address">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out addressLocality shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function prop_aloc_gen($atts, $content = null){
			$html = '<span itemprop="addressLocality">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out addressRegion shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function prop_areg_gen($atts, $content = null){
			$html = '<span itemprop="addressRegion">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out author shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_auth_gen($atts, $content = null){
			extract( shortcode_atts( array(
				'type' => '',
			), $atts ) );
			if (isset($type) && $type == 'Person'){
				$html = '<span itemprop="author" itemscope itemtype="http://schema.org/Person">'.do_shortcode($content).'</span>';
			}
			else $html = '<span itemprop="author">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out description shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_desc_gen($atts, $content = null){
			$html = '<span itemprop="description">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out publisher shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function prop_pub_gen($atts, $content = null){
			extract( shortcode_atts( array(
				'type' => '',
			), $atts ) );
			if (isset($type) && $type == 'Organization'){
				$html = '<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization">'.do_shortcode($content).'</span>';
			}
			else $html = '<span itemprop="publisher">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out publisher shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function prop_dir_gen($atts, $content = null){
			extract( shortcode_atts( array(
				'type' => '',
			), $atts ) );
			if (isset($type) && $type == 'Person'){
				$html = '<span itemprop="director" itemscope itemtype="http://schema.org/Person">'.do_shortcode($content).'</span>';
			}
			else $html = '<span itemprop="director">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out image shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function prop_img_gen($atts, $content = null){
			extract( shortcode_atts( array(
				'src' => '',
				'alt' => '',
				'width' => '',
				'height' => '',
				'class' => '',
				'align' => '',
			), $atts ) );
			$html = '<img ';

			if (isset($src))
				$html .= 'src="'.$src.'" ';
				//$html .= $src;

			if (isset($alt))
				$html .= 'alt="'.$alt.'" ';

			if (isset($width))
				$html .= 'width="'.$width.'" ';

			if (isset($height))
				$html .= 'height="'.$height.'" ';

			if (isset($class))
				$html .= 'class="'.$class.'" ';

			if (isset($align))
				$html .= 'align="'.$align.'" ';

			$html .= 'itemprop="image" />';
			return $html;
		}

		/** Build out jobTitle shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_job_gen($atts, $content = null){
			$html = '<span itemprop="jobTitle">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out birthDate shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_bdate_gen($atts, $content = null){
			extract( shortcode_atts( array(
				'cntnt' => '',
			), $atts ) );
			$html = '<meta itemprop="birthDate" content="'.$cntnt.'">';
			return $html;
		}

		/** Build out street shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_street_gen($atts, $content = null){
			$html = '<span itemprop="streetAddress">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out postalCode shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_zip_gen($atts, $content = null){
			$html = '<span itemprop="postalCode">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out email shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_email_gen($atts, $content = null){
			extract( shortcode_atts( array(
				'mailto' => '',
			), $atts ) );
			if (isset($mailto)){
				$html = '<a itemprop="email" href="mailto:'.$mailto.'">'.do_shortcode($content).'</a>';
			}
			else $html = '<span itemprop="email">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out addressCountry shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_acntry_gen($atts, $content = null){
			$html = '<span itemprop="addressCountry">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out itemReviewed shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_itmrv_gen($atts, $content = null){
			$html = '<span itemprop="itemReviewed">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out reviewRating shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function prop_rrating_gen($atts, $content = null){
			extract( shortcode_atts( array(
				'type' => '',
			), $atts ) );
			if (isset($type) && $type == 'Rating'){
				$html = '<span itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">'.do_shortcode($content).'</span>';
			}
			else $html = '<span itemprop="reviewRating">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out ratingValue shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_rval_gen($atts, $content = null){
			$html = '<span itemprop="ratingValue">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out sameAs shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function prop_sameas_gen($atts, $content = null){
			extract( shortcode_atts( array(
				'url' => '',
				'target' => '',
			), $atts ) );
			if (isset($target) && $target == 'Blank'){
				$html = '<a itemprop="sameAs" href="'.$url.'" target="_blank">'.do_shortcode($content).'</a>';
			}
			else $html = '<a itemprop="sameAs" href="'.$url.'">'.do_shortcode($content).'</a>';
			return $html;
		}

		/** Build out video shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function prop_video_gen($atts, $content = null){
			extract( shortcode_atts( array(
				'type' => '',
			), $atts ) );
			if (isset($type) && $type == 'VideoObject'){
				$html = '<span itemprop="video" itemscope itemtype="http://schema.org/VideoObject">'.do_shortcode($content).'</span>';
			}
			else $html = '<span itemprop="video">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out podcast shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function prop_podcast_gen($atts, $content = null){
			extract( shortcode_atts( array(
				'type' => '',
			), $atts ) );
			if (isset($type) && $type == 'PodcastObject'){
				$html = '<span itemprop="podcast" itemscope itemtype="http://schema.org/AudioObject http://schema.org/AudioObject/PodcastObject">'.do_shortcode($content).'</span>';
			}
			else $html = '<span itemprop="podcast">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out itemListElement shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_itmle_gen($atts, $content = null){
			$html = '<span itemprop="itemListElement">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out itemListOrder shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_itmlo_gen($atts, $content = null){
			$html = '<span itemprop="itemListOrder">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out webinar shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		 */
		public function prop_webinar_gen($atts, $content = null){
			extract( shortcode_atts( array(
				'type' => '',
			), $atts ) );
			if (isset($type) && $type == 'WebinarObject'){
				$html = '<span itemprop="webinar" itemscope itemtype="http://schema.org/MediaObject http://schema.org/MediaObject/WebinarObject">'.do_shortcode($content).'</span>';
			}
			else $html = '<span itemprop="webinar">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out brand shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_brand_gen($atts, $content = null){
			$html = '<span itemprop="brand">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out makesOffer shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_mkffr_gen($atts, $content = null){
			$html = '<span itemprop="makesOffer">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out datePosted shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_dateposted_gen($atts, $content = null){
			$html = '<span itemprop="datePosted">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out experienceRequirements shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_expreqs_gen($atts, $content = null){
			$html = '<span itemprop="experienceRequirements">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out hiringOrganization shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_hrngorg_gen($atts, $content = null){
			extract( shortcode_atts( array(
				'type' => '',
			), $atts ) );
			if (isset($type) && $type == 'Organization'){
				$html = '<span itemprop="hiringOrganization" itemscope itemtype="http://schema.org/Organization">'.do_shortcode($content).'</span>';
			}
			else $html = '<span itemprop="hiringOrganization">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out benefits shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_bnfts_gen($atts, $content = null){
			$html = '<span itemprop="benefits">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out incentives shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_incnts_gen($atts, $content = null){
			$html = '<span itemprop="incentives">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out industry shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_ind_gen($atts, $content = null){
			$html = '<span itemprop="industry">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out jobLocation shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_jobloc_gen($atts, $content = null){
			extract( shortcode_atts( array(
				'type' => '',
			), $atts ) );
			if (isset($type) && $type == 'Place'){
				$html = '<span itemprop="jobLocation" itemscope itemtype="http://schema.org/Place">'.do_shortcode($content).'</span>';
			}
			else $html = '<span itemprop="jobLocation">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out attendee shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_attnd_gen($atts, $content = null){
			$html = '<span itemprop="attendee">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out logo shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_logo_gen($atts, $content = null){
			$html = '<span itemprop="logo">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out offers shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_offers_gen($atts, $content = null){
			$html = '<span itemprop="offers">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out performer shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_prfrmr_gen($atts, $content = null){
			$html = '<span itemprop="performer">'.do_shortcode($content).'</span>';
			return $html;
		}

		/** Build out worksFor shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function prop_wrksfr_gen($atts, $content = null){
			$html = '<span itemprop="worksFor">'.do_shortcode($content).'</span>';
			return $html;
		}


		/*************/
		// other
		/*************/

		/** Build out rendertool shortcode
		 *
		 * @param string $atts shortcode attributes
		 * @param string $content shortcode content
		 * @return string processed shortcode
		*/
		public function rendertool_gen($atts, $content = null){
			$html = '<p>'.do_shortcode($content).'</p>';
			return $html;
		}

	/// end class
	}

	// Instantiate our class
	$schemaInserter = new SchemaInserter();
endif;

/**********************************/
// schema button in TinyMCE editor
/**********************************/


function add_schema_button() {
   // Only do this stuff when the current user has permissions and we are in Rich Editor mode
   if ( ( current_user_can('edit_posts') || current_user_can('edit_pages') ) && get_user_option('rich_editing') ) {
     add_filter("mce_external_plugins", "tinymce_schema_plugin");
     add_filter('mce_buttons', 'register_schema_button');
   }
}

function register_schema_button($buttons) {
   array_push($buttons, "|", "schema_button");
   return $buttons;
}

// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function tinymce_schema_plugin($plugin_array) {
   $plugin_array['schema_button'] = plugins_url('schema.tinymce.editor.js', __FILE__);
   return $plugin_array;
}

// init process for button control
add_action('init', 'add_schema_button');
