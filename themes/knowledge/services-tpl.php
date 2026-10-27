<?php
/*
// Template Name: Services Template
*/

// VDS Solutions inquiry form handler (the modal form below).
// The page is served from the LiteSpeed cache for longer than a nonce lives, so an expired
// nonce must not drop an inquiry: it only tags the subject. Bots are stopped by vds_hp,
// a field that must be present and left empty.
if ( isset( $_POST['vds_inquiry_submit'] ) && isset( $_POST['vds_hp'] ) && '' === $_POST['vds_hp'] ) {
	$vds_field   = function ( $key ) {
		return isset( $_POST[ $key ] ) ? wp_unslash( $_POST[ $key ] ) : '';
	};
	$vds_service = sanitize_text_field( $vds_field( 'service_name' ) );
	$vds_service = '' === $vds_service ? 'General Inquiry' : $vds_service;
	$vds_name    = sanitize_text_field( $vds_field( 'inquiry_name' ) );
	$vds_email   = sanitize_email( $vds_field( 'inquiry_email' ) );
	$vds_company = sanitize_text_field( $vds_field( 'inquiry_company' ) );
	$vds_message = sanitize_textarea_field( $vds_field( 'inquiry_message' ) );
	$vds_fresh   = wp_verify_nonce( $vds_field( 'vds_nonce' ), 'vds_inquiry' );

	$vds_subject = 'VDS Inquiry: ' . $vds_service . ( $vds_fresh ? '' : ' (sent from an older cached page)' );
	$vds_body    = "Service: " . $vds_service . "\nName: " . $vds_name . "\nEmail: " . $vds_email . "\nCompany: " . $vds_company . "\n\nMessage:\n" . $vds_message;
	$vds_headers = array( 'Content-Type: text/plain; charset=UTF-8' );
	if ( is_email( $vds_email ) ) {
		$vds_headers[] = 'Reply-To: ' . $vds_name . ' <' . $vds_email . '>';
	}
	wp_mail( 'enquiries@vietnam-directsourcing.com', $vds_subject, $vds_body, $vds_headers );
	wp_safe_redirect( add_query_arg( 'inquiry', 'sent', get_permalink( 13 ) ) );
	exit;
}
get_header();
$heading_small_banner_services = get_field('heading_small_banner_services');
$heading_big_banner_services = get_field('heading_big_banner_services');

?>
<!--slider-area start-->
<?php 
        $hide_banneer = get_field('hide_banneer');     
        
         if(empty( $hide_banneer ) || $hide_banneer[0] !=='yes') { ?>
        <section class="page-title-area sky-blue-bg pt-280 pb-180 pt-lg-200 pt-md-160 pb-md-120 pt-xs-160 pb-xs-90">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="page-title-wrapper text-center">
                        <h1 class="h1 page-title"><?= $heading_big_banner_services;?></h1>
                            <h4 class="styled-text theme-color mb-30"><?= $heading_small_banner_services;?></h4>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
        <!--slider-area end-->

<?php if (get_the_ID() == 13) : ?>
<!--solutions-services start-->

<!-- VDS Inquiry Modal -->
<div id="vds-inquiry-modal" role="dialog" aria-modal="true" aria-labelledby="vds-modal-title">
  <div class="vds-inquiry-box">
    <button type="button" class="vds-inquiry-close" aria-label="Close">&times;</button>
    <p class="vds-eyebrow">GET IN TOUCH</p>
    <h3 id="vds-modal-title">Send an Inquiry</h3>
    <p class="vds-inquiry-note">We respond within 24 business hours.</p>
    <form method="POST">
      <?php echo wp_nonce_field('vds_inquiry', 'vds_nonce', true, false); ?>
      <input type="hidden" name="vds_inquiry_submit" value="1">
      <div class="vds-hp" aria-hidden="true"><label>Leave this field empty <input type="text" name="vds_hp" value="" tabindex="-1" autocomplete="off"></label></div>
      <input type="hidden" name="service_name" id="vds-service-name" value="">
      <div class="vds-field">
        <label for="vds-inquiry-name">Full Name *</label>
        <input type="text" id="vds-inquiry-name" name="inquiry_name" required placeholder="Your name">
      </div>
      <div class="vds-field">
        <label for="vds-inquiry-email">Email Address *</label>
        <input type="email" id="vds-inquiry-email" name="inquiry_email" required placeholder="your@email.com">
      </div>
      <div class="vds-field">
        <label for="vds-inquiry-company">Company</label>
        <input type="text" id="vds-inquiry-company" name="inquiry_company" placeholder="Your company (optional)">
      </div>
      <div class="vds-field vds-field--last">
        <label for="vds-inquiry-message">Brief Product / Project Description *</label>
        <textarea id="vds-inquiry-message" name="inquiry_message" required rows="4" placeholder="Describe what you're looking to source..."></textarea>
      </div>
      <button class="vds-inquiry-submit" type="submit">Send Inquiry &rarr;</button>
    </form>
  </div>
</div>

<?php if (isset($_GET['inquiry']) && $_GET['inquiry'] === 'sent') : ?>
<div class="vds-inquiry-sent">
  &#10003; Thank you! Your inquiry has been received. We'll be in touch within 24 business hours.
</div>
<?php endif; ?>

<!--== SECTION 1: Core Sourcing Pipeline ==-->
<section class="vds-sol vds-sol--pipeline">
  <div class="container">
    <div class="vds-sol__head">
      <p class="vds-eyebrow">VIETNAM SOURCING SERVICES</p>
      <h2 class="vds-sol__title">Our Structured Sourcing Pipeline</h2>
      <p class="vds-sol__lede">A four-stage process that takes you from initial supplier search through to full supply chain management in Vietnam.</p>
    </div>

    <!-- Step 01 -->
    <div class="row align-items-center vds-sol-step">
      <div class="col-lg-6 col-md-12 mb-30">
        <img class="vds-sol-step__img" src="https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Supplier-Identification.png" alt="Warehouse aisle stacked with wooden pallets">
      </div>
      <div class="col-lg-6 col-md-12 mb-30 vds-sol-step__copy vds-sol-step__copy--right">
        <p class="vds-eyebrow">STEP 01</p>
        <h3 class="vds-sol__heading" id="supplier-identification">Supplier Identification</h3>
        <p class="vds-sol__tagline">Fast-track your search for a flat US$250.</p>
        <p class="vds-sol__body">Designed for buyers seeking existing Vietnamese products with minimal to no customization. Using our sourcing database, we match your exact product specifications and target pricing with vetted, export-ready manufacturers.</p>
        <ul class="vds-sol__list">
          <li>&#10003;&nbsp;&nbsp;Checked Factory Contact Details</li>
          <li>&#10003;&nbsp;&nbsp;Export Product &amp; Capability Lists</li>
          <li>&#10003;&nbsp;&nbsp;International Quality Certifications</li>
          <li>&#10003;&nbsp;&nbsp;Initial Factory Price Sheets</li>
        </ul>
        <button class="vds-sol__btn" type="button" data-vds-inquiry="Request Supplier Identification List">Request Supplier Identification List &rarr;</button>
      </div>
    </div>

    
    <!-- Step 02 -->
    <div class="row align-items-center vds-sol-step">
      <div class="col-lg-6 col-md-12 order-lg-2 mb-30">
        <img class="vds-sol-step__img" src="https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Supplier-Inspection.png" alt="Inspector checking a wood sample">
      </div>
      <div class="col-lg-6 col-md-12 order-lg-1 mb-30 vds-sol-step__copy vds-sol-step__copy--left">
        <p class="vds-eyebrow">STEP 02</p>
        <h3 class="vds-sol__heading" id="supplier-evaluation">Supplier Evaluation</h3>
        <p class="vds-sol__tagline">Pre-qualify partners for custom manufacturing and OEM projects. US$750 flat fee.</p>
        <p class="vds-sol__body">If your product requires custom tooling, specialized materials, or prototyping, we go deeper. We physically pre-qualify factories, manage the initial RFQ process to secure pro-forma quotes, coordinate sample production, and facilitate a supplier introduction call.</p>
        <ul class="vds-sol__list">
          <li>&#10003;&nbsp;&nbsp;Comprehensive Supplier Audit Reports</li>
          <li>&#10003;&nbsp;&nbsp;Pro-Forma Quotes &amp; Cost Breakdowns</li>
          <li>&#10003;&nbsp;&nbsp;Custom Sample Production Management</li>
          <li>&#10003;&nbsp;&nbsp;Facilitated Supplier Introduction Call</li>
        </ul>
        <button class="vds-sol__btn" type="button" data-vds-inquiry="Inquire About Supplier Evaluation">Inquire About Supplier Evaluation &rarr;</button>
      </div>
    </div>

    <!-- Step 03 -->
    <div class="row align-items-center vds-sol-step">
      <div class="col-lg-6 col-md-12 mb-30">
        <img class="vds-sol-step__img" src="https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Production-Management.png" alt="Operator running a CNC machine">
      </div>
      <div class="col-lg-6 col-md-12 mb-30 vds-sol-step__copy vds-sol-step__copy--right">
        <p class="vds-eyebrow">STEP 03</p>
        <h3 class="vds-sol__heading" id="production-management">Production Management</h3>
        <p class="vds-sol__tagline">Protect your investment from the factory floor to the shipping container.</p>
        <p class="vds-sol__body">Bridge the gap between a signed contract and a finished shipment. We provide local, on-site production oversight in Vietnam to ensure raw material lead times are met, engineering blueprints are strictly followed, and manufacturing bottlenecks are cleared before they cause delays.</p>
        <ul class="vds-sol__list">
          <li>&#10003;&nbsp;&nbsp;Milestone Tracking &amp; Progress Reports</li>
          <li>&#10003;&nbsp;&nbsp;On-the-Floor Production Monitoring</li>
          <li>&#10003;&nbsp;&nbsp;Timeline Slip Remediation</li>
          <li>&#10003;&nbsp;&nbsp;Post-Production Handoff Coordination</li>
        </ul>
        <button class="vds-sol__btn" type="button" data-vds-inquiry="Get Production Management Support">Get Production Management Support &rarr;</button>
      </div>
    </div>

    <!-- Step 04 -->
    <div class="row align-items-center vds-sol-step">
      <div class="col-lg-6 col-md-12 order-lg-2 mb-30">
        <img class="vds-sol-step__img" src="https://vietnam-directsourcing.com/wp-content/uploads/2026/06/End-to-end.png" alt="Forklift loading a shipping container">
      </div>
      <div class="col-lg-6 col-md-12 order-lg-1 mb-30 vds-sol-step__copy vds-sol-step__copy--left">
        <p class="vds-eyebrow">STEP 04</p>
        <h3 class="vds-sol__heading" id="end-to-end">End-to-End Solution</h3>
        <p class="vds-sol__tagline">One team on the ground, from blueprint to final delivery.</p>
        <p class="vds-sol__body">Our most comprehensive turnkey solution. We act as your dedicated, boots-on-the-ground supply chain team in Vietnam — from initial identification, strict contract negotiations, and production oversight, all the way through to final logistics scheduling.</p>
        <ul class="vds-sol__list">
          <li>&#10003;&nbsp;&nbsp;Full-Scale Supply Chain Management</li>
          <li>&#10003;&nbsp;&nbsp;Sourcing &amp; Price Negotiations</li>
          <li>&#10003;&nbsp;&nbsp;Integrated Logistics &amp; Freight Scheduling</li>
          <li>&#10003;&nbsp;&nbsp;Dedicated Account Manager in Vietnam</li>
        </ul>
        <button class="vds-sol__btn" type="button" data-vds-inquiry="Discuss End-to-End Sourcing">Discuss End-to-End Sourcing &rarr;</button>
      </div>
    </div>

  </div>
</section>

<!--== SECTION 1.5: Ongoing Sourcing for Repeat Shippers ==-->
<section class="vds-sol vds-sol--repeat">
  <div class="container">
    <div class="vds-sol__head">
      <p class="vds-eyebrow">FOR REPEAT SHIPPERS</p>
      <h2 class="vds-sol__title">Ongoing Sourcing, Once You’re Shipping Regularly</h2>
      <p class="vds-sol__lede">For clients moving containers on a regular cadence, production management moves to a fixed fee per container or an optional monthly retainer — never a commission, never a long contract.</p>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-12 mb-40">
        <div class="vds-sol-tier">
          <p class="vds-eyebrow">TIER A</p>
          <h3 class="vds-sol__heading">Per-Container Management</h3>
          <p class="vds-sol__tagline">A fixed fee per container — no retainer required.</p>
          <p class="vds-sol__body">Once you’re shipping on a regular cadence, ongoing production management moves to a flat fee per container cycle — covering spec enforcement, inspection coordination, shipping-document follow-through and landed-cost reconciliation. The fee is the same whether your container is worth $40,000 or $120,000.</p>
          <ul class="vds-sol__list">
            <li>&#10003;&nbsp;&nbsp;Spec Lock &amp; Written QC Plan Carried Forward</li>
            <li>&#10003;&nbsp;&nbsp;Inspection Coordination Every Cycle</li>
            <li>&#10003;&nbsp;&nbsp;Shipping-Document Follow-Through</li>
            <li>&#10003;&nbsp;&nbsp;Landed-Cost Reconciliation</li>
          </ul>
          <button class="vds-sol__btn" type="button" data-vds-inquiry="Per-Container Management">Talk About Per-Container Pricing &rarr;</button>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 mb-40">
        <div class="vds-sol-tier">
          <p class="vds-eyebrow">TIER B</p>
          <h3 class="vds-sol__heading">Sourcing Partner Retainer</h3>
          <p class="vds-sol__tagline">Standing capacity between shipments, from $1,850/month.</p>
          <p class="vds-sol__body">For clients with real work between containers — supplier development, price renegotiation, compliance follow-up — a monthly retainer keeps a dedicated resource on call, with quarterly reviews and priority response. No minimum term: 30 days’ notice, either side.</p>
          <ul class="vds-sol__list">
            <li>&#10003;&nbsp;&nbsp;Ongoing Supplier Relationship Management</li>
            <li>&#10003;&nbsp;&nbsp;Quarterly Sourcing Review</li>
            <li>&#10003;&nbsp;&nbsp;Priority Response Ahead of Ad-Hoc Work</li>
            <li>&#10003;&nbsp;&nbsp;No Minimum Term — 30 Days’ Notice</li>
          </ul>
          <button class="vds-sol__btn" type="button" data-vds-inquiry="Sourcing Partner Retainer">Discuss the Sourcing Partner Retainer &rarr;</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!--== SECTION 2: On-the-Ground Execution Services ==-->
<section class="vds-sol vds-sol--dark">
  <div class="container">
    <div class="vds-sol__head">
      <p class="vds-eyebrow">ON-THE-GROUND EXECUTION</p>
      <h2 class="vds-sol__title">Additional Execution Services</h2>
      <p class="vds-sol__lede">Standalone services available independently or as part of a broader sourcing engagement.</p>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-12 mb-40">
        <div class="vds-sol-service">
          <img class="vds-sol-service__img" src="https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Factory-Tours.png" alt="Visitors touring a factory floor with a guide">
          <div class="vds-sol-service__body">
            <p class="vds-eyebrow">SERVICE A</p>
            <h3 class="vds-sol__heading" id="factory-tours">Tailored Factory Tours</h3>
            <p class="vds-sol__tagline">Inspect facilities, build relationships and negotiate face-to-face. US$200 per day, interpretation included.</p>
            <p class="vds-sol__body">Establish long-term strategic relationships by walking the factory floors yourself. We build custom, efficient itineraries tailored to your specific industry. Our bilingual industrial guides accompany you to handle cultural nuances, logistics, and real-time translation during hard business negotiations.</p>
            <ul class="vds-sol__list">
              <li>&#10003;&nbsp;&nbsp;Customized Multi-Factory Itineraries</li>
              <li>&#10003;&nbsp;&nbsp;Bilingual Technical Translators</li>
              <li>&#10003;&nbsp;&nbsp;Pre-Verified Production Suitability</li>
              <li>&#10003;&nbsp;&nbsp;Local Transportation &amp; Logistics Handling</li>
            </ul>
            <button class="vds-sol__btn vds-sol__btn--gold" type="button" data-vds-inquiry="Book a Tailored Factory Tour">Book a Tailored Factory Tour &rarr;</button>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 mb-40">
        <div class="vds-sol-service">
          <img class="vds-sol-service__img" src="https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Quality-Assurance.png" alt="Inspector checking manufactured goods">
          <div class="vds-sol-service__body">
            <p class="vds-eyebrow">SERVICE B</p>
            <h3 class="vds-sol__heading" id="quality-assurance">Rigorous Quality Assurance</h3>
            <p class="vds-sol__tagline">International compliance standards verified independently on-site.</p>
            <p class="vds-sol__body">Working with an international third-party quality assurance firm, we conduct objective, strict audits right at the factory machines. From raw material verification to final container loading inspections, we ensure your goods meet precise technical blueprints.</p>
            <ul class="vds-sol__list">
              <li>&#10003;&nbsp;&nbsp;Independent Pre-Shipment Inspections</li>
              <li>&#10003;&nbsp;&nbsp;ISO/Social Compliance Factory Audits</li>
              <li>&#10003;&nbsp;&nbsp;Lab Testing &amp; Certification Procedures</li>
              <li>&#10003;&nbsp;&nbsp;Defect Sorting &amp; Corrective Action Plans</li>
            </ul>
            <button class="vds-sol__btn vds-sol__btn--gold" type="button" data-vds-inquiry="Schedule a Quality Inspection">Schedule a Quality Inspection &rarr;</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--solutions-services end-->
<?php endif; ?>

        
        <!-- Widget -->
        <?php
        $hide_trustindex = get_post_meta(get_the_ID(), 'hide_trustindex', true);
        $trustindex_embed_code = get_post_meta(get_the_ID(), 'trustindex_embed_code', true);
        if(empty( $hide_trustindex ) || $hide_trustindex !== 'a:1:{i:0;s:3:"yes";}') {
            if (!empty($trustindex_embed_code)) { ?>
        <div class="container">
            <div class="trustindex-area py-5">
                <?php echo str_replace('data-tf-live=', 'data-tf-widget=', $trustindex_embed_code); ?>
            </div>
        </div>
        <?php } elseif ( is_active_sidebar( 'trust-index' ) ) { ?>
        <div class="container">
            <ul id="widget-trust-index">
                <?php dynamic_sidebar( 'trust-index' ); ?>
            </ul>
        </div>
        <?php } } ?>

        <!--call-to-action start-->
        <?php 
        $hide_services_bottom = get_field('hide_services_bottom');    
        // var_dump($hide_services_bottom);     
         if(empty( $hide_services_bottom ) || $hide_services_bottom[0] !=='yes') { ?>
        <?php get_template_part( 'template-parts/cta' ); ?>
        <?php } ?>
        <!--call-to-action end-->
<?php
get_footer();