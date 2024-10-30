<?php
/*
Plugin Name: Loan EMI Calculator
Plugin URI: https://wordpress.org/simplifyplugin/
description: Use this calculator to work out the approximate monthly repayments you will need to make on a personal loan or mortgage. 
Version: 1.0
Author: Vasim Shaikh
Author URI: https://wordpress.org/simplifyplugin/
License: GPL2 or higher
*/


// Create an admin menu 
add_action('admin_menu', 'lec_plugin_setup_menu');
 
function lec_plugin_setup_menu(){
        add_menu_page( 'Loan Calculator', 'Loan Calculator', 'manage_options', 'loan-plugin', 'lec_loan_calculator_page' ,'dashicons-editor-table');      
        add_submenu_page( 'loan-plugin', 'Loan Parameter Setting', 'Setting',
    'manage_options', 'loan-plugin-setting','lec_loan_default_parameret_options');
} 


 // Add admin page for  Calculator
function lec_loan_calculator_page(){
        ?>
<div class="container">
    
    <h2>How to configure a Loan calculator</h2>
    <hr>
    <div class="row">
        <div class="article col-md-12 col-sm-6 col-xs-12">
            <!-- content do not mind about this -->
           
            <div class="content">
                <h3 class="title">Use in Page or Post</h3>
                <p class="snippet">
                <ul>
                <li> 1) Create a page or post. </li>
                <li> 2) Go text area and add code 
                <strong>[loancalculator] </strong> </li>
                 <li> 3) Save a page. </li>
                </ul>
                </p>
        </div>

      
        </div>
  
     
        </div>
        <div class="row">
        <div class="article col-md-4 col-sm-6 col-xs-12">
            <!-- content do not mind about this -->
           
            <div class="content">
                <h3 class="title">Use in Widget</h3>
                <p class="snippet">
                <ul>
                <li> 1) Go to widget menu in appreance. </li>
                <li> 2) Drag text widget in widget area and add code 
                <strong>[loancalculator] </strong> </li>
                 <li> 3) Save a widget. all done. </li>
                </ul>
                </p>
        </div>
            <!-- /end content -->
        </div>
      
        </div>

        </div>
        <?php
}

// Display a calculator shortcode

function lec_loancalculator_display_shortcode(  ) {
    $outpthtml=' <section class="calculator homeloan_repayment">
		<div class="container">
				<div class="row">
						<div class="calc-input">
							<form>
									<div class="col-md-12">
											<div style="border:1px solid #161616;"> 
												<div>
													<div class="col-sm-12 sub-title">
														<h4>'.get_option('lec_main_heading').'</h4>
													</div>
														<div class="loanboxinner">
															<div class="loan-rate-term loan-rate-term-details">
																	<div class="col-xs-12 col-sm-12 col-md-12">
																		<div class="col-sm-12 col-xs-12">
																			<label>LOAN AMOUNT :</label>
																		</div>
																		<input type="hidden" id="file_charge" value="'. get_option('lec_filecharge').'"/>
																		<input type="hidden" id="lec_monthly_interest" value="'. get_option('lec_monthly_interest').'"/>
																		
																		<div class="col-sm-8 col-xs-12">
																			<div class="range-slider">
																				<div class="slider" id="intrestraterange"></div>
																			
																			</div>
																		</div>
																		<div class="col-sm-4 col-xs-12 box-style">
																			<span class="txt_input" id="intrestrate">$1000</span>
																			<!--<input type="text" name="" id="intrestrate" class="txt_input">-->
																		</div>
																	</div>

																	<div class="col-xs-12 col-sm-12 col-md-12">
																		<div class="col-sm-12">
																			<label>LOAN TERM :</label>
																		</div>
																		<div class="col-sm-8 col-xs-12">
																			<div class="range-slider">
																				<div class="slider2" id="loantermrange"></div>
																				
																			</div>
																		</div>
																		<div class="col-sm-4 col-xs-12 box-style">
																			<div id="loadterm">4 Months</div>
																		
																		</div>
																	</div>


																	
																	<div class="col-xs-12 col-sm-12 col-md-12">
																		<div class="col-sm-8">&nbsp;</div>
																		<div class="col-sm-4">&nbsp;</div>
																	</div>
																	
																	<div class="col-xs-12 col-sm-12 col-md-12" style="border-top:2px solid #e7e7e7;">
																		<div class="col-sm-8">&nbsp;</div>
																		<div class="col-sm-4">&nbsp;</div>
																	</div>
																	<div class="col-xs-12 col-sm-12 col-md-12">
																		<div class="col-sm-8">
																			<label>Loan amount</label>
																		</div>
																		<div class="col-sm-4">
																			<div id="borrow_amount_res">$360</div>
																		</div>
																	</div>
																	
																	<div class="col-xs-12 col-sm-12 col-md-12">
																		<div class="col-sm-8">
																			<label>Interest and fees</label>
																		</div>
																		<div class="col-sm-4">
																			<div id="interest_fees_res">$72.63</div>
																		</div>
																	</div>
																	
																	<div class="col-xs-12 col-sm-12 col-md-12">
																		<div class="col-sm-8">
																			<label>Total repayments</label>
																		</div>
																		<div class="col-sm-4">
																			<div id="repay_res">$432.63</div>
																		</div>
																	</div>
																	
																	<div class="col-xs-12 col-sm-12 col-md-12">
																		<div class="col-sm-8">
																			<label><span id="weekly_change">1</span> weekly repayments of </label>
																		</div>
																		<div class="col-sm-4">
																			<div id="weekly_payment_res">$432.63</div>
																		</div>
																	</div>
															</div>
														</div>	
												</div>	
											</div>
									</div>
							</form>
						</div>
				</div>
		</div>
   </section>';
   
   return $outpthtml;
}
add_shortcode( 'loancalculator', 'lec_loancalculator_display_shortcode' );


// Add boostrap css for admin area.

add_action('admin_enqueue_scripts', 'lec_callback_for_setting_up_scripts_admin');

function lec_callback_for_setting_up_scripts_admin() {
wp_register_style( 'matin-bootstrap', plugin_dir_url( __FILE__ ) . 'assets/css/bootstrap.min.css' );
wp_enqueue_style( 'matin-bootstrap' );
}

// Add CSS and JS for front page

add_action('wp_enqueue_scripts', 'lec_callback_for_setting_up_scripts');
function lec_callback_for_setting_up_scripts() {

   wp_register_style( 'Jquery-UI-CSS', plugin_dir_url( __FILE__ ) . 'assets/css/jquery-ui.css' );
	wp_register_style( 'matin-bootstrap', plugin_dir_url( __FILE__ ) . 'assets/css/bootstrap.min.css' );

	wp_register_style( 'matin-style', plugin_dir_url( __FILE__ ) . 'assets/css/styles.css' );
	
   wp_enqueue_style( 'Jquery-UI-CSS' );
	wp_enqueue_style( 'matin-bootstrap' );
	wp_enqueue_style( 'matin-style' );
    wp_enqueue_script( 'jquery-ui-slider' );
	wp_enqueue_script( 'matin-jquery-ui-punch', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.ui.touch-punch.min.js',array('jquery-ui-slider'));
	wp_enqueue_script( 'loanscript', plugin_dir_url( __FILE__ ) . 'assets/js/loanscript.js',array( 'jquery' ) ); 
	
}

function lec_loan_default_parameret_options()
{
?>
    <div class="wrap">
    	<div class="row">
<div class="col-sm-4 col-xs-12 col-md-12">
        <h2>Default option values</h2>
    </div>
    </div>
    <div class="row">
    	<div class="col-sm-4 col-xs-12 col-md-12">
        <fieldset>
        <form method="post" action="options.php">
            <?php wp_nonce_field('update-options') ?>
            <p><strong>Calculator Heading:</strong><br />
                <input type="text" name="lec_main_heading" size="45" value="<?php echo get_option('lec_main_heading','Loan Calculator'); ?>" />
            </p>
            <p><strong>File Charges:</strong><br />
                <input type="text" name="lec_filecharge" size="45" value="<?php echo get_option('lec_filecharge','325'); ?>" />
            </p>
<p><strong>Monthly Interest Rate:</strong><br />
                <input type="text" name="lec_monthly_interest" size="45" value="<?php echo get_option('lec_monthly_interest','12.50'); ?>" />
            </p>

            

            <p><input type="submit" name="Submit" value="Save Changes"  class="button-primary" /></p>
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="lec_main_heading" />
            <input type="hidden" name="page_options" value="lec_filecharge" />
            <input type="hidden" name="page_options" value="lec_monthly_interest" />
        </form>
        </fieldset>
        </div>
    </div>
    </div>
<?php
}