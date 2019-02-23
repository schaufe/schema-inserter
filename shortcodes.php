<?php
/**
 * Form to choose the schema types and insert attributes
 * Upon "insert" the appropriate shortcode wraps around highlighted text
 */
?>

<?php ob_start(); ?>
<?php
include ('tinymce_addon_scripts.php');
?>
<head>
	<title>Shortcode Insertion</title>
	<script type="text/javascript" src="lib/js/dialog.js"></script>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form onSubmit="ShortcodesDialog.insert();return false;" action="#" method="post">
		<div class="mceActionPanel">
			<script type="text/javascript" language="javascript">
				var selected_content = tinyMCE.activeEditor.selection.getContent();
				
				/**
				 * Retrieves values and wraps shortcode around highlighted text
				 */
				function InsertSchema(){

					//retrieve values
					var schema_type = jQuery('select#schema_type').val();
					var type = jQuery('select#type').val();
					var prop = jQuery('select#prop').val();
					var other = jQuery('select#other').val();
					var href_url = jQuery('div#href_url_wrap #href_url').val();
					var isPlace = jQuery('div#place_check_wrap input#place_check').is(':checked');
					var isPostalAddr = jQuery('div#postaladdr_check_wrap input#postaladdr_check').is(':checked');
					var isOrg = jQuery('div#org_check_wrap input#org_check').is(':checked');
					var isPerson = jQuery('div#person_check_wrap input#person_check').is(':checked');
					var isReview = jQuery('div#rev_check_wrap input#rev_check').is(':checked');
					var isBlankTarget = jQuery('div#target_check_wrap input#target_check').is(':checked');
					var isVideoObject = jQuery('div#vidobj_check_wrap input#vidobj_check').is(':checked');
					var isPodcastObject = jQuery('div#podobj_check_wrap input#podobj_check').is(':checked');
					var isWebinarObject = jQuery('div#wbnobj_check_wrap input#wbnobj_check').is(':checked');
					var isHiringOrg = jQuery('div#hrngorg_check_wrap input#hrngorg_check').is(':checked');
					var isJobPlace = jQuery('div#jobplace_check_wrap input#jobplace_check').is(':checked');
					var year = jQuery('div#date_wrap input#year').val();
					var month = jQuery('div#date_wrap input#month').val();
					var day = jQuery('div#date_wrap input#day').val();
					var hh = jQuery('div#timepick_wrap input#hh').val();
					var mm = jQuery('div#timepick_wrap input#mm').val();
					var ss = jQuery('div#timepick_wrap input#ss').val();
					var mailto = jQuery('div#mailto_wrap input#mailto').val();
					var img_src = jQuery('div#img_src_wrap input#img_src').val();
					var img_alt = jQuery('div#img_alt_wrap input#img_alt').val();
					var img_width = jQuery('div#img_width_wrap input#img_width').val();
					var img_height = jQuery('div#img_height_wrap input#img_height').val();
					var img_class = jQuery('div#img_class_wrap input#img_class').val();
					var img_align = jQuery('div#img_align_wrap select#img_align').val();

					var img_build = "[prop_img ";
					var url_build = "[prop_"+prop+" url="+href_url+" ";
					var date_build = "[prop_"+prop+" cntnt="+year+"-"+month+"-"+day;

					//wrap shortcode around highlighted text depending on values
					if (schema_type == 'type' && type != 'none'){
						tinyMCE.execCommand('mceInsertContent',false, '[type_'+type+']' + selected_content + '[/type_'+type+']');
					}
					else if (schema_type == 'prop' && prop != 'none'){
						if (prop == 'url' || prop == 'sameas'){
							if (isBlankTarget === true){
								url_build += "target=\"Blank\"]";
							}
							else url_build += "]";
							tinyMCE.execCommand('mceInsertContent',false, url_build + selected_content + '[/prop_'+prop+']');
						}
						else if (prop == 'loc' && isPlace === true){
							tinyMCE.execCommand('mceInsertContent',false, '[prop_'+prop+' type="Place"]' + selected_content + '[/prop_'+prop+']');	
						}
						else if (prop == 'addr' && isPostalAddr === true){
							tinyMCE.execCommand('mceInsertContent',false, '[prop_'+prop+' type="PostalAddress"]' + selected_content + '[/prop_'+prop+']');
						}
						else if (prop == 'pub' && isOrg === true){
							tinyMCE.execCommand('mceInsertContent',false, '[prop_'+prop+' type="Organization"]' + selected_content + '[/prop_'+prop+']');
						}
						else if (prop == 'rrating' && isReview === true){
							tinyMCE.execCommand('mceInsertContent',false, '[prop_'+prop+' type="Review"]' + selected_content + '[/prop_'+prop+']');
						}
						else if (prop == 'video' && isVideoObject === true){
							tinyMCE.execCommand('mceInsertContent',false, '[prop_'+prop+' type="VideoObject"]' + selected_content + '[/prop_'+prop+']');
						}
						else if (prop == 'podcast' && isPodcastObject === true){
							tinyMCE.execCommand('mceInsertContent',false, '[prop_'+prop+' type="PodcastObject"]' + selected_content + '[/prop_'+prop+']');
						}
						else if (prop == 'webinar' && isWebinarObject === true){
							tinyMCE.execCommand('mceInsertContent',false, '[prop_'+prop+' type="WebinarObject"]' + selected_content + '[/prop_'+prop+']');
						}
						else if (prop == 'hrngorg' && isHiringOrg === true){
							tinyMCE.execCommand('mceInsertContent',false, '[prop_'+prop+' type="Organization"]' + selected_content + '[/prop_'+prop+']');
						}
						else if (prop == 'jobloc' && isJobPlace === true){
							tinyMCE.execCommand('mceInsertContent',false, '[prop_'+prop+' type="Place"]' + selected_content + '[/prop_'+prop+']');
						}
						else if ( (prop == 'auth' || prop == 'dir') && isPerson === true){
							tinyMCE.execCommand('mceInsertContent',false, '[prop_'+prop+' type="Person"]' + selected_content + '[/prop_'+prop+']');
						}
						else if (prop == 'sdate' || prop == 'edate' || prop == 'bdate'){
							if (prop == 'sdate' || prop == 'edate'){
								tinyMCE.execCommand('mceInsertContent',false, date_build+'T'+hh+':'+mm+':'+ss+']' + selected_content);
							}
							else tinyMCE.execCommand('mceInsertContent',false, date_build+']' + selected_content);
						}
						else if (prop == 'img'){
							if (img_src){
								img_build += 'src="'+img_src+'" ';
							}
							if (img_alt){
								img_build += 'alt="'+img_alt+'" ';
							}
							if (img_width){
								img_build += 'width="'+img_width+'" ';
							}
							if (img_height){
								img_build += 'height="'+img_height+'" ';
							}
							if (img_class){
								img_build += 'class="'+img_class+'" ';
							}
							if (img_align != 'none'){
								img_build += 'align="'+img_align+'" ';
							}

							img_build += ']';
							tinyMCE.execCommand('mceInsertContent',false, img_build);
						}
						else if (prop == 'email'){
							tinyMCE.execCommand('mceInsertContent',false, '[prop_'+prop+' mailto="'+mailto+'"]' + selected_content + '[/prop_'+prop+']');
						}
						else tinyMCE.execCommand('mceInsertContent',false, '[prop_'+prop+']' + selected_content + '[/prop_'+prop+']');
					}
					else if (schema_type == 'other' && other != 'none'){
						if (other == 'rendertool'){
							tinyMCE.execCommand('mceInsertContent',false, '[rendertool]' + selected_content + '[/rendertool]');
						}
					}

					if (prop != 'none' || type != 'none' || other != 'none'){
						tinyMCEPopup.close();
					}
					else {
						if (schema_type == 'none'){
							document.getElementById('alert').innerHTML = "Please choose between \"Type\", \"Property\", and \"Other\"";
						}
						else if (schema_type != 'none'){ 
							if (schema_type == 'type' && type == 'none'){
								document.getElementById('alert').innerHTML = "Please choose a type";
							}
							if (schema_type == 'prop' && prop == 'none'){
								document.getElementById('alert').innerHTML = "Please choose a prop";
							}
							if (schema_type == 'other' && other == 'none'){
								document.getElementById('alert').innerHTML = "Please choose an option";
							}
						}
						else document.getElementById('alert').innerHTML = "An error has occurred.  Please try again";
					}
				}

				//logic to display form fields
				jQuery(document).ready(function($) {
				
					hide_child_dropdowns();

					hide_all_fields();

					function hide_all_fields(){
						$('div#alert_wrap span#alert').html('&nbsp;');
						$('div#rec_wrap span#rec').html('&nbsp;');
						$('div#warn_wrap span#warn').html('&nbsp;');
						$('div#addlwarn_wrap span#addlwarn').html('&nbsp;');
						$('div#href_url_wrap').hide();
						$('div#place_check_wrap').hide();
						$('div#postaladdr_check_wrap').hide();
						$('div#org_check_wrap').hide();
						$('div#person_check_wrap').hide();
						$('div#date_wrap').hide();
						$('div#img_src_wrap').hide();
						$('div#img_alt_wrap').hide();
						$('div#img_width_wrap').hide();
						$('div#img_height_wrap').hide();
						$('div#img_class_wrap').hide();
						$('div#img_align_wrap').hide();
						$('div#mailto_wrap').hide();
						$('div#rev_check_wrap').hide();
						$('div#target_check_wrap').hide();
						$('div#vidobj_check_wrap').hide();
						$('div#podobj_check_wrap').hide();
						$('div#wbnobj_check_wrap').hide();
						$('div#hrngorg_check_wrap').hide();
						$('div#jobplace_check_wrap').hide();
						$('div#timepick_wrap').hide();

					}


					function hide_child_dropdowns(){
						$('div#sc_type').hide();
						$('div#sc_prop').hide();
						$('div#sc_other').hide();
					}

					function reset_child_dropdowns(){
						$('select#type').val('none');
						$('select#prop').val('none');
						$('select#other').val('none');
					}

					//upon schema_type option change
					$('div#schema_form select#schema_type').change( function() {
						$('select#schema_type option:selected').attr('selected', 'selected');
						$('select#schema_type option:not(:selected)').removeAttr('selected');

						hide_child_dropdowns();
						reset_child_dropdowns();

						hide_all_fields();

						var schema_type = $(this).val();	// get the selected value to trigger form changes

						if (schema_type == 'type'){
							$('div#sc_type').show();
						}
						if (schema_type == 'prop'){
							$('div#sc_prop').show();
						}

						if (schema_type == 'other'){
							$('div#sc_other').show();
						}

						//upon type option change
						$('div#schema_form select#type').change( function(){
							$('select#type option:selected').attr('selected', 'selected');
							$('select#type option:not(:selected)').removeAttr('selected');

							hide_all_fields();

							var type = $(this).val();

							//alert("type under type change: "+type); //to debug

							if (type == 'person'){
								$('div#rec_wrap span#rec').text('Recommendation: include the itemprop \"name\" within \"Person\"');
							}

							if (type == 'event'){
								$('div#rec_wrap span#rec').text('Recommendation: include the itemprops \"name\", \"url\", \"location\", and \"start date\" within \"Event\"');
							}

							if (type == 'org'){
								$('div#rec_wrap span#rec').text('Recommendation: include the itemprop \"name\" within \"Organization\"');
							}

						});

						//upon prop option change
						$('div#schema_form select#prop').change( function(){
							$('select#prop option:selected').attr('selected', 'selected');
							$('select#prop option:not(:selected)').removeAttr('selected');

							hide_all_fields();

							var prop = $(this).val();

							if (prop == 'url' || prop == 'sameas'){
								$('div#href_url_wrap').show();
								$('div#target_check_wrap').show();
							}

							if (prop == 'loc'){
								$('div#place_check_wrap').show();
							}

							if (prop == 'sdate' || prop == 'edate' || prop == 'bdate'){
								if (prop == 'sdate' || prop == 'edate'){
									$('div#timepick_wrap').show();
									$('div#warn_wrap span#warn').text('Use the format YYYY-MM-DD');
									$('div#addlwarn_wrap span#addlwarn').text('Use the format hh:mm:ss');
								}
								else $('div#warn_wrap span#warn').text('Use the format YYYY-MM-DD');
								$('div#date_wrap').show();
							}

							if (prop == 'addr'){
								$('div#postaladdr_check_wrap').show();
							}

							if (prop == 'pub'){
								$('div#org_check_wrap').show();
							}

							if (prop == 'auth' || prop == 'dir'){
								$('div#person_check_wrap').show();
							}

							if (prop == 'img'){
								$('div#img_src_wrap').show();
								$('div#img_alt_wrap').show();
								$('div#img_width_wrap').show();
								$('div#img_height_wrap').show();
								$('div#img_class_wrap').show();
								$('div#img_align_wrap').show();
								$('div#warn_wrap span#warn').text('Warning: these image attributes are advanced and will affect the <img /> html tag');
								$('div#rec_wrap span#rec').text('Recommendation: wrap this image within a supporting type, such as \"Person\"');
							}

							if (prop == 'telephone'){
								$('div#rec_wrap span#rec').text('Recommendation: wrap this itemprop within the type \"Person\" or another supporting type');
							}

							if (prop == 'zip'){
								$('div#rec_wrap span#rec').text('Recommendation: wrap this itemprop within the type \"PostalAddress\"');
							}

							if (prop == 'email'){
								$('div#mailto_wrap').show();
								$('div#warn_wrap span#warn').text('Warning: if text is entered it will be used as a \"mailto\" link');
							}

							if (prop == 'acntry' || prop == 'aloc'|| prop == 'areg'){
								$('div#rec_wrap span#rec').text('Recommendation: wrap this itemprop within the type \"PostalAddress\"');
							}

							if (prop == 'rrating'){
								$('div#rev_check_wrap').show();
							}

							if (prop == 'video'){
								$('div#vidobj_check_wrap').show();
							}

							if (prop == 'podcast'){
								$('div#podobj_check_wrap').show();
							}

							if (prop == 'webinar'){
								$('div#wbnobj_check_wrap').show();
							}

							if (prop == 'hrngorg'){
								$('div#hrngorg_check_wrap').show();
							}

							if (prop == 'jobloc'){
								$('div#jobplace_check_wrap').show();
							}

							if (prop == 'dateposted'){
								$('div#warn_wrap span#warn').text('Warning: value will be expected in ISO 8601 date format');
							}

						}); //end upon prop change
						
						//upon other option change
						$('div#schema_form select#other').change( function(){
							$('select#other option:selected').attr('selected', 'selected');
							$('select#other option:not(:selected)').removeAttr('selected');

							hide_all_fields();

						}); //end upon other change

					}); //end upon schema change
					
				});	// end

			</script>


			<!--form-->
			<div id="schema_form">
				<div id="sc_schema_type">
					<label for="schema-type">Schema Type</label>
					<select id="schema_type" name="schema_type">
						<option value="none" selected="selected">Choose one...</option>
						<option value="type">Type (itemtype)</option>
						<option value="prop">Property (itemprop)</option>
						<option value="other">Other</option>
					</select>
				</div> <!--div #sc_schema_type-->

				<div id="sc_type">
					<label for="type">Type</label>
					<select id="type" name="type">
						<option value="none" selected="selected">Select A Type</option>
						<option value="article">Article</option>
						<option value="bpost">BlogPosting</option>
						<option value="book">Book</option>
						<option value="bevent">BusinessEvent</option>
						<option value="brand">Brand</option>
						<option value="corp">Corporation</option>
						<option value="event">Event</option>
						<option value="imgobj">ImageObject</option>
						<option value="itemlist">ItemList</option>
						<option value="jobpstng">JobPosting</option>
						<option value="lbus">LocalBusiness</option>
						<option value="mediaobj">MediaObject</option>
						<option value="movie">Movie</option>
						<option value="offer">Offer</option>
						<option value="org">Organization</option>
						<option value="person">Person</option>
						<option value="place">Place</option>
						<option value="podobj">PodcastObject</option>
						<option value="postaladdr">PostalAddress</option>
						<option value="rating">Rating</option>
						<option value="review">Review</option>
						<option value="slevent">SaleEvent</option>
						<option value="sclevent">SocialEvent</option>
						<option value="techartcl">TechArticle</option>
						<option value="thing">Thing</option>
						<option value="tvseries">TVSeries</option>
						<option value="vidobj">VideoObject</option>
						<option value="wbnobj">WebinarObject</option>
					</select>
				</div> <!--div #sc_type-->

				<div id="sc_prop">
					<label for="prop">Property</label>
					<select id="prop" name="prop">
						<option value="none" selected="selected">Select A Property</option>
						<option value="addr">address</option>
						<option value="acntry">addressCountry</option>
						<option value="aloc">addressLocality</option>
						<option value="areg">addressRegion</option>
						<option value="affil">affiliation</option>
						<option value="attnd">attendee</option>
						<option value="auth">author</option>
						<option value="bdate">birthDate</option>
						<option value="bnfts">benefits</option>
						<option value="brand">brand</option>
						<option value="dateposted">datePosted</option>
						<option value="desc">description</option>
						<option value="dir">director</option>
						<option value="edate">endDate</option>
						<option value="email">email</option>
						<option value="expreqs">experienceRequirements</option>
						<option value="hrngorg">hiringOrganization</option>
						<option value="incnts">incentives</option>
						<option value="ind">industry</option>
						<option value="img">image</option>
						<option value="itmle">itemListElement</option>
						<option value="itmlo">itemListOrder</option>
						<option value="itmrv">itemReviewed</option>
						<option value="jobloc">jobLocation</option>
						<option value="job">jobTitle</option>
						<option value="loc">location</option>
						<option value="logo">logo</option>
						<option value="mkffr">makesOffer</option>
						<option value="name">name</option>
						<option value="offers">offers</option>
						<option value="prfrmr">performer</option>
						<option value="podcast">podcast</option>
						<option value="zip">postalCode</option>
						<option value="pub">publisher</option>
						<option value="rval">ratingValue</option>
						<option value="rrating">reviewRating</option>
						<option value="sameas">sameAs</option>
						<option value="sdate">startDate</option>
						<option value="street">streetAddress</option>
						<option value="phone">telephone</option>
						<option value="url">url</option>
						<option value="video">video</option>
						<option value="webinar">webinar</option>
						<option value="wrksfr">worksFor</option>
					</select>
				</div> <!--div #sc_prop-->

				<div id="sc_other">
					<label for="other">Other</label>
					<select id="other" name="other">
						<option value="none">Select An Option</option>
						<option value="rendertool">render tool</option>
					</select>
				</div> <!-- div #sc_other-->

				<!--url-->
				<div id="href_url_wrap">
					<label for="href_url">URL: </label>
					<input type="text" id="href_url" name="href_url" class="form_full" />
				</div>

				<!--Place check option-->
				<div id="place_check_wrap" class="checkbox form_list">
					<span>
						<input type="checkbox" id="place_check" name="place_check" value="Place" />
						<label for="place_check">Place is needed</label>
					</span>
				</div>

				<!--PostalAddress check option-->
				<div id="postaladdr_check_wrap" class="checkbox form_list">
					<span>
						<input type="checkbox" id="postaladdr_check" name="postaladdr_check" value="PostalAddress" />
						<label for="postal_addr_check">PostalAddress is needed</label>
					</span>
				</div>

				<!--Organization check option-->
				<div id="org_check_wrap" class="checkbox form_list">
					<span>
						<input type="checkbox" id="org_check" name="org_check" value="Organization" />
						<label for="org_check">Organization is needed</label>
					</span>
				</div>

				<!--Person check option-->
				<div id="person_check_wrap" class="checkbox form_list">
					<span>
						<input type="checkbox" id="person_check" name="person_check" value="Person" />
						<label for="person_check">Person is needed</label>
					</span>
				</div>
				
				<!--Review check option-->
				<div id="rev_check_wrap" class="checkbox form_list">
					<span>
						<input type="checkbox" id="rev_check" name="rev_check" value="Rating" />
						<label for="rev_check">Review is needed</label>
					</span>
				</div>

				<!--Open link in new window/tab check option-->
				<div id="target_check_wrap" class="checkbox form_list">
					<span>
						<input type="checkbox" id="target_check" name="target_check" value="Target" />
						<label for="target_check">Open link in new window/tab</label>
					</span>
				</div>

				<!--VideoObject check option-->
				<div id="vidobj_check_wrap" class="checkbox form_list">
					<span>
						<input type="checkbox" id="vidobj_check" name="vidobj_check" value="VideoObject" />
						<label for="vidobj_check">VideoObject is needed</label>
					</span>
				</div>

				<!--PodcastObject check option-->
				<div id="podobj_check_wrap" class="checkbox form_list">
					<span>
						<input type="checkbox" id="podobj_check" name="podobj_check" value="PodcastObject" />
						<label for="podobj_check">PodcastObject is needed</label>
					</span>
				</div>

				<!--WebinarObject check option-->
				<div id="wbnobj_check_wrap" class="checkbox form_list">
					<span>
						<input type="checkbox" id="wbnobj_check" name="wbnobj_check" value="WebinarObject" />
						<label for="wbnobj_check">WebinarObject is needed</label>
					</span>
				</div>

				<!--hiringOrganization check option-->
				<div id="hrngorg_check_wrap" class="checkbox form_list">
					<span>
						<input type="checkbox" id="hrngorg_check" name="hrngorg_check" value="hrngorg" />
						<label for="hrngorg_check">Organization is needed</label>
					</span>
				</div> 

				<!--jobPlace check option-->
				<div id="jobplace_check_wrap" class="checkbox form_list">
					<span>
						<input type="checkbox" id="jobplace_check" name="jobplace_check" value="JobPlace" />
						<label for="jobplace_check">Place is needed</label>
					</span>
				</div> 

				<!--img src-->
				<div id="img_src_wrap">
					<label for="img_src">src: </label>
					<input type="text" id="img_src" name="img_src" class="form_full" />
				</div>

				<!--img alt-->
				<div id="img_alt_wrap">
					<label for="img_alt">alt: </label>
					<input type="text" id="img_alt" name="img_alt" class="form_full" />
				</div>

				<!--img width-->
				<div id="img_width_wrap">
					<label for="img_width">width: </label>
					<input type="text" id="img_width" name="img_width" class="form_eighth" />
				</div>

				<!--img height-->
				<div id="img_height_wrap">
					<label for="img_height">height: </label>
					<input type="text" id="img_height" name="img_height" class="form_eighth" />
				</div>

				<!--img class-->
				<div id="img_class_wrap">
					<label for="img_class">class: </label>
					<input type="text" id="img_class" name="img_class" class="form_third" />
				</div>

				<!--img alignment-->
				<div id="img_align_wrap">
					<label for="img_align">align: </label>
					<select id="img_align" name="img_align">
						<option value="none">none</option>
						<option value="right">right</option>
						<option value="center">center</option>
						<option value="left">left</option>
					</select>
				</div>

				<!--date picker-->
				<div id="date_wrap">
					<label for="date">Enter the date: </label>
					<input type="text" id="year" name="year" value="" maxlength="4" size="4" class="form_eighth" />
					<input type="text" id="month" name="month" value="" maxlength="2" size="2" class="form_eighth" />
					<input type="text" id="day" name="day" value="" maxlength="2" size="2" class="form_eighth" />
				</div>

				<!--time picker-->
				<div id="timepick_wrap">
					<label for="timepick">Enter the time: </label>
					<input type="text" id="hh" name="hh" value="" maxlength="2" size="2" class="form_eighth" />
					<input type="text" id="mm" name="mm" value="" maxlength="2" size="2" class="form_eighth" />
					<input type="text" id="ss" name="ss" value="" maxlength="2" size="2" class="form_eighth" />
				</div>

				<!--mailto-->
				<div id="mailto_wrap">
					<label for="mailto">email to link: </label>
					<input type="text" id="mailto" name="mailto" class="form_third" />
				</div>

				<!-- alert/warning -->
				<div id="alert_wrap" class="warning">
					<span id="alert">&nbsp;</span>
				</div>

				<!-- recommendation -->
				<div id="rec_wrap" class="recommendation">
					<span id="rec">&nbsp;</span>
				</div>

				<!-- warning -->
				<div id="warn_wrap" class="warning">
					<span id="warn">&nbsp;</span>
				</div> 

				<!-- additional warning -->
				<div id="addlwarn_wrap" class="warning">
					<span id="addlwarn">&nbsp;</span>
				</div>

			</div> <!--div #schema_form"-->
			
		</div> <!--div .mceActionPanel"-->

		<div class="mceActionPanel">
				<!-- button for inserting -->
				<div class="insert_button">
					<input type="button" class="schema_button" value="Insert" onclick="InsertSchema();"/>
				</div>
  			<div style="float:left;padding-top:5px"></div>
		</div>
	</form>
</body>