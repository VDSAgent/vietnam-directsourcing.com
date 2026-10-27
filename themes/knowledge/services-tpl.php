<?php
/*
// Template Name: Services Template
*/

// VDS Solutions inquiry form handler
if ( isset($_POST['vds_inquiry_submit']) && isset($_POST['vds_nonce']) ) {
    if ( wp_verify_nonce($_POST['vds_nonce'], 'vds_inquiry') ) {
        $vds_to      = 'contactus@vietnam-directsourcing.com';
        $vds_service = sanitize_text_field(isset($_POST['service_name']) ? $_POST['service_name'] : 'General Inquiry');
        $vds_name    = sanitize_text_field(isset($_POST['inquiry_name']) ? $_POST['inquiry_name'] : '');
        $vds_email   = sanitize_email(isset($_POST['inquiry_email']) ? $_POST['inquiry_email'] : '');
        $vds_company = sanitize_text_field(isset($_POST['inquiry_company']) ? $_POST['inquiry_company'] : '');
        $vds_message = sanitize_textarea_field(isset($_POST['inquiry_message']) ? $_POST['inquiry_message'] : '');
        $vds_subject = 'VDS Inquiry: ' . $vds_service;
        $vds_body    = "Service: " . $vds_service . "\nName: " . $vds_name . "\nEmail: " . $vds_email . "\nCompany: " . $vds_company . "\n\nMessage:\n" . $vds_message;
        $vds_headers = array('Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $vds_name . ' <' . $vds_email . '>');
        wp_mail( $vds_to, $vds_subject, $vds_body, $vds_headers );
        wp_redirect( esc_url( add_query_arg('inquiry', 'sent', get_permalink(13)) ) );
        exit;
    }
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
<div id="vds-inquiry-modal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.65);z-index:9999;align-items:center;justify-content:center;">
  <div style="background:#fff;border-radius:12px;padding:40px;max-width:520px;width:92%;position:relative;max-height:90vh;overflow-y:auto;">
    <button type="button" class="vds-inquiry-close" aria-label="Close" style="position:absolute;top:14px;right:18px;background:none;border:none;font-size:26px;cursor:pointer;color:#999;line-height:1;">&times;</button>
    <p style="color:#e8693c;font-weight:700;font-size:12px;letter-spacing:2px;text-transform:uppercase;margin-bottom:6px;">GET IN TOUCH</p>
    <h3 id="vds-modal-title" style="color:#1a2a4a;font-size:22px;margin-bottom:4px;">Send an Inquiry</h3>
    <p style="color:#888;font-size:14px;margin-bottom:24px;">We respond within 24 business hours.</p>
    <form method="POST">
      <?php echo wp_nonce_field('vds_inquiry', 'vds_nonce', true, false); ?>
      <input type="hidden" name="vds_inquiry_submit" value="1">
      <input type="hidden" name="service_name" id="vds-service-name" value="">
      <div style="margin-bottom:15px;">
        <label style="display:block;font-size:13px;font-weight:600;color:#333;margin-bottom:5px;">Full Name *</label>
        <input type="text" name="inquiry_name" required placeholder="Your name" style="width:100%;padding:10px 14px;border:1px solid #ddd;border-radius:6px;font-size:14px;box-sizing:border-box;">
      </div>
      <div style="margin-bottom:15px;">
        <label style="display:block;font-size:13px;font-weight:600;color:#333;margin-bottom:5px;">Email Address *</label>
        <input type="email" name="inquiry_email" required placeholder="your@email.com" style="width:100%;padding:10px 14px;border:1px solid #ddd;border-radius:6px;font-size:14px;box-sizing:border-box;">
      </div>
      <div style="margin-bottom:15px;">
        <label style="display:block;font-size:13px;font-weight:600;color:#333;margin-bottom:5px;">Company</label>
        <input type="text" name="inquiry_company" placeholder="Your company (optional)" style="width:100%;padding:10px 14px;border:1px solid #ddd;border-radius:6px;font-size:14px;box-sizing:border-box;">
      </div>
      <div style="margin-bottom:24px;">
        <label style="display:block;font-size:13px;font-weight:600;color:#333;margin-bottom:5px;">Brief Product / Project Description *</label>
        <textarea name="inquiry_message" required rows="4" placeholder="Describe what you're looking to source..." style="width:100%;padding:10px 14px;border:1px solid #ddd;border-radius:6px;font-size:14px;box-sizing:border-box;resize:vertical;"></textarea>
      </div>
      <button type="submit" style="width:100%;background:#1a2a4a;color:#fff;border:none;padding:14px;border-radius:6px;font-size:15px;font-weight:600;cursor:pointer;">Send Inquiry &rarr;</button>
    </form>
  </div>
</div>

<?php if (isset($_GET['inquiry']) && $_GET['inquiry'] === 'sent') : ?>
<div style="background:#d4edda;color:#155724;padding:14px;text-align:center;font-size:15px;border-bottom:1px solid #c3e6cb;">
  &#10003; Thank you! Your inquiry has been received. We'll be in touch within 24 business hours.
</div>
<?php endif; ?>

<!--== SECTION 1: Core Sourcing Pipeline ==-->
<section style="background:#fff;padding:90px 0 50px;">
  <div class="container">
    <div style="text-align:center;margin-bottom:60px;">
      <p style="color:#e8693c;font-weight:700;font-size:12px;letter-spacing:2px;text-transform:uppercase;margin-bottom:10px;">VIETNAM SOURCING SERVICES</p>
      <h2 style="color:#1a2a4a;font-size:38px;font-weight:800;margin-bottom:16px;">Our Structured Sourcing Pipeline</h2>
      <p style="color:#666;max-width:620px;margin:0 auto;font-size:16px;line-height:1.8;">A four-stage process that takes you from initial supplier search through to full supply chain management in Vietnam.</p>
    </div>

    <!-- Step 01 -->
    <div class="row align-items-center" style="margin-bottom:90px;">
      <div class="col-lg-6 col-md-12 mb-30">
        <img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Supplier-Identification.png" alt="Supplier Identification service — warehouse full of wooden pallets in Vietnam" style="width:100%;border-radius:12px;display:block;">
      </div>
      <div class="col-lg-6 col-md-12 mb-30" style="padding-left:45px;">
        <p style="color:#e8693c;font-weight:700;font-size:12px;letter-spacing:2px;text-transform:uppercase;margin-bottom:8px;">STEP 01</p>
        <h3 style="color:#1a2a4a;font-size:32px;font-weight:700;margin-bottom:10px;">Supplier Identification</h3>
        <p style="color:#e8693c;font-style:italic;font-size:16px;margin-bottom:18px;font-weight:500;">Fast track your search for only $250 USD!</p>
        <p style="color:#555;font-size:15px;line-height:1.85;margin-bottom:22px;">Designed for buyers seeking existing Vietnamese products with minimal to no customization. Powered by our proprietary sourcing database, we match your exact product specifications and target pricing with vetted, export-ready manufacturers.</p>
        <ul style="list-style:none;padding:0;margin:0 0 30px;">
          <li style="padding:7px 0;color:#333;font-size:14px;border-bottom:1px solid #f0f0f0;">&#10003;&nbsp;&nbsp;Verified Factory Contact Details</li>
          <li style="padding:7px 0;color:#333;font-size:14px;border-bottom:1px solid #f0f0f0;">&#10003;&nbsp;&nbsp;Export Product &amp; Capability Lists</li>
          <li style="padding:7px 0;color:#333;font-size:14px;border-bottom:1px solid #f0f0f0;">&#10003;&nbsp;&nbsp;International Quality Certifications</li>
          <li style="padding:7px 0;color:#333;font-size:14px;">&#10003;&nbsp;&nbsp;Initial Factory Price Sheets</li>
        </ul>
        <button type="button" data-vds-inquiry="Request Supplier Identification List" style="background:#1a2a4a;color:#fff;border:none;padding:14px 30px;border-radius:6px;font-size:14px;font-weight:600;cursor:pointer;">Request Supplier Identification List &rarr;</button>
      </div>
    </div>

    
    <!-- Step 02 -->
    <div class="row align-items-center" style="margin-bottom:90px;">
      <div class="col-lg-6 col-md-12 order-lg-2 mb-30">
        <img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Supplier-Inspection.png" alt="Supplier Evaluation — inspecting wood sample for OEM manufacturing" style="width:100%;border-radius:12px;display:block;">
      </div>
      <div class="col-lg-6 col-md-12 order-lg-1 mb-30" style="padding-right:45px;">
        <p style="color:#e8693c;font-weight:700;font-size:12px;letter-spacing:2px;text-transform:uppercase;margin-bottom:8px;">STEP 02</p>
        <h3 style="color:#1a2a4a;font-size:32px;font-weight:700;margin-bottom:10px;">Supplier Evaluation</h3>
        <p style="color:#e8693c;font-style:italic;font-size:16px;margin-bottom:18px;font-weight:500;">Pre-qualify partners for custom manufacturing and OEM projects.</p>
        <p style="color:#555;font-size:15px;line-height:1.85;margin-bottom:22px;">If your product requires custom tooling, specialized materials, or prototyping, we go deeper. We physically pre-qualify factories, manage the initial RFQ process to secure pro-forma quotes, coordinate sample production, and facilitate a supplier introduction call.</p>
        <ul style="list-style:none;padding:0;margin:0 0 30px;">
          <li style="padding:7px 0;color:#333;font-size:14px;border-bottom:1px solid #f0f0f0;">&#10003;&nbsp;&nbsp;Comprehensive Supplier Audit Reports</li>
          <li style="padding:7px 0;color:#333;font-size:14px;border-bottom:1px solid #f0f0f0;">&#10003;&nbsp;&nbsp;Pro-Forma Quotes &amp; Cost Breakdowns</li>
          <li style="padding:7px 0;color:#333;font-size:14px;border-bottom:1px solid #f0f0f0;">&#10003;&nbsp;&nbsp;Custom Sample Production Management</li>
          <li style="padding:7px 0;color:#333;font-size:14px;">&#10003;&nbsp;&nbsp;Facilitated Supplier Introduction Call</li>
        </ul>
        <button type="button" data-vds-inquiry="Inquire About Supplier Evaluation" style="background:#1a2a4a;color:#fff;border:none;padding:14px 30px;border-radius:6px;font-size:14px;font-weight:600;cursor:pointer;">Inquire About Supplier Evaluation &rarr;</button>
      </div>
    </div>

    <!-- Step 03 -->
    <div class="row align-items-center" style="margin-bottom:90px;">
      <div class="col-lg-6 col-md-12 mb-30">
        <img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Production-Management.png" alt="Production Management — CNC machine operator in Vietnam factory" style="width:100%;border-radius:12px;display:block;">
      </div>
      <div class="col-lg-6 col-md-12 mb-30" style="padding-left:45px;">
        <p style="color:#e8693c;font-weight:700;font-size:12px;letter-spacing:2px;text-transform:uppercase;margin-bottom:8px;">STEP 03</p>
        <h3 style="color:#1a2a4a;font-size:32px;font-weight:700;margin-bottom:10px;">Production Management</h3>
        <p style="color:#e8693c;font-style:italic;font-size:16px;margin-bottom:18px;font-weight:500;">Protect your investment from the factory floor to the shipping container.</p>
        <p style="color:#555;font-size:15px;line-height:1.85;margin-bottom:22px;">Bridge the gap between a signed contract and a finished shipment. We provide local, on-site production oversight in Vietnam to ensure raw material lead times are met, engineering blueprints are strictly followed, and manufacturing bottlenecks are cleared before they cause delays.</p>
        <ul style="list-style:none;padding:0;margin:0 0 30px;">
          <li style="padding:7px 0;color:#333;font-size:14px;border-bottom:1px solid #f0f0f0;">&#10003;&nbsp;&nbsp;Milestone Tracking &amp; Progress Reports</li>
          <li style="padding:7px 0;color:#333;font-size:14px;border-bottom:1px solid #f0f0f0;">&#10003;&nbsp;&nbsp;On-the-Floor Production Monitoring</li>
          <li style="padding:7px 0;color:#333;font-size:14px;border-bottom:1px solid #f0f0f0;">&#10003;&nbsp;&nbsp;Timeline Slip Remediation</li>
          <li style="padding:7px 0;color:#333;font-size:14px;">&#10003;&nbsp;&nbsp;Post-Production Handoff Coordination</li>
        </ul>
        <button type="button" data-vds-inquiry="Get Production Management Support" style="background:#1a2a4a;color:#fff;border:none;padding:14px 30px;border-radius:6px;font-size:14px;font-weight:600;cursor:pointer;">Get Production Management Support &rarr;</button>
      </div>
    </div>

    <!-- Step 04 -->
    <div class="row align-items-center" style="margin-bottom:40px;">
      <div class="col-lg-6 col-md-12 order-lg-2 mb-30">
        <img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/06/End-to-end.png" alt="End-to-End Sourcing Solution — forklift loading shipping container in Vietnam" style="width:100%;border-radius:12px;display:block;">
      </div>
      <div class="col-lg-6 col-md-12 order-lg-1 mb-30" style="padding-right:45px;">
        <p style="color:#e8693c;font-weight:700;font-size:12px;letter-spacing:2px;text-transform:uppercase;margin-bottom:8px;">STEP 04</p>
        <h3 style="color:#1a2a4a;font-size:32px;font-weight:700;margin-bottom:10px;">End-to-End Solution</h3>
        <p style="color:#e8693c;font-style:italic;font-size:16px;margin-bottom:18px;font-weight:500;">Complete operational peace of mind from blueprint to final delivery.</p>
        <p style="color:#555;font-size:15px;line-height:1.85;margin-bottom:22px;">Our most comprehensive turnkey solution. We act as your dedicated, boots-on-the-ground supply chain team in Vietnam — from initial identification, strict contract negotiations, and production oversight, all the way through to final logistics scheduling.</p>
        <ul style="list-style:none;padding:0;margin:0 0 30px;">
          <li style="padding:7px 0;color:#333;font-size:14px;border-bottom:1px solid #f0f0f0;">&#10003;&nbsp;&nbsp;Full-Scale Supply Chain Management</li>
          <li style="padding:7px 0;color:#333;font-size:14px;border-bottom:1px solid #f0f0f0;">&#10003;&nbsp;&nbsp;Sourcing &amp; Price Negotiations</li>
          <li style="padding:7px 0;color:#333;font-size:14px;border-bottom:1px solid #f0f0f0;">&#10003;&nbsp;&nbsp;Integrated Logistics &amp; Freight Scheduling</li>
          <li style="padding:7px 0;color:#333;font-size:14px;">&#10003;&nbsp;&nbsp;Dedicated Account Manager in Vietnam</li>
        </ul>
        <button type="button" data-vds-inquiry="Apply for End-to-End Sourcing" style="background:#1a2a4a;color:#fff;border:none;padding:14px 30px;border-radius:6px;font-size:14px;font-weight:600;cursor:pointer;">Apply for End-to-End Sourcing &rarr;</button>
      </div>
    </div>

  </div>
</section>

<!--== SECTION 1.5: Ongoing Sourcing for Repeat Shippers ==-->
<section style="background:#fff;padding:0 0 90px;">
  <div class="container">
    <div style="text-align:center;margin-bottom:60px;">
      <p style="color:#e8693c;font-weight:700;font-size:12px;letter-spacing:2px;text-transform:uppercase;margin-bottom:10px;">FOR REPEAT SHIPPERS</p>
      <h2 style="color:#1a2a4a;font-size:38px;font-weight:800;margin-bottom:16px;">Ongoing Sourcing, Once You’re Shipping Regularly</h2>
      <p style="color:#666;max-width:620px;margin:0 auto;font-size:16px;line-height:1.8;">For clients moving containers on a regular cadence, production management moves to a fixed fee per container or an optional monthly retainer — never a commission, never a long contract.</p>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-12 mb-40">
        <div style="border-radius:12px;background:#fff;border:1px solid #eee;box-shadow:0 2px 16px rgba(0,0,0,0.05);height:100%;display:flex;flex-direction:column;padding:36px;">
          <p style="color:#e8693c;font-weight:700;font-size:12px;letter-spacing:2px;text-transform:uppercase;margin-bottom:8px;">TIER A</p>
          <h3 style="color:#1a2a4a;font-size:26px;font-weight:700;margin-bottom:10px;">Per-Container Management</h3>
          <p style="color:#e8693c;font-style:italic;font-size:15px;margin-bottom:16px;font-weight:500;">A fixed fee per container — no retainer required.</p>
          <p style="color:#555;font-size:15px;line-height:1.85;margin-bottom:22px;flex:1;">Once you’re shipping on a regular cadence, ongoing production management moves to a flat fee per container cycle — covering spec enforcement, inspection coordination, shipping-document follow-through and landed-cost reconciliation. The fee is the same whether your container is worth $40,000 or $120,000.</p>
          <ul style="list-style:none;padding:0;margin:0 0 26px;">
            <li style="padding:6px 0;color:#333;font-size:14px;border-bottom:1px solid #f0f0f0;">&#10003;&nbsp;&nbsp;Spec Lock &amp; Written QC Plan Carried Forward</li>
            <li style="padding:6px 0;color:#333;font-size:14px;border-bottom:1px solid #f0f0f0;">&#10003;&nbsp;&nbsp;Inspection Coordination Every Cycle</li>
            <li style="padding:6px 0;color:#333;font-size:14px;border-bottom:1px solid #f0f0f0;">&#10003;&nbsp;&nbsp;Shipping-Document Follow-Through</li>
            <li style="padding:6px 0;color:#333;font-size:14px;">&#10003;&nbsp;&nbsp;Landed-Cost Reconciliation</li>
          </ul>
          <button type="button" data-vds-inquiry="Per-Container Management" style="background:#1a2a4a;color:#fff;border:none;padding:14px 30px;border-radius:6px;font-size:14px;font-weight:600;cursor:pointer;">Talk About Per-Container Pricing &rarr;</button>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 mb-40">
        <div style="border-radius:12px;background:#fff;border:1px solid #eee;box-shadow:0 2px 16px rgba(0,0,0,0.05);height:100%;display:flex;flex-direction:column;padding:36px;">
          <p style="color:#e8693c;font-weight:700;font-size:12px;letter-spacing:2px;text-transform:uppercase;margin-bottom:8px;">TIER B</p>
          <h3 style="color:#1a2a4a;font-size:26px;font-weight:700;margin-bottom:10px;">Sourcing Partner Retainer</h3>
          <p style="color:#e8693c;font-style:italic;font-size:15px;margin-bottom:16px;font-weight:500;">Standing capacity between shipments, from $1,850/month.</p>
          <p style="color:#555;font-size:15px;line-height:1.85;margin-bottom:22px;flex:1;">For clients with real work between containers — supplier development, price renegotiation, compliance follow-up — a monthly retainer keeps a dedicated resource on call, with quarterly reviews and priority response. No minimum term: 30 days’ notice, either side.</p>
          <ul style="list-style:none;padding:0;margin:0 0 26px;">
            <li style="padding:6px 0;color:#333;font-size:14px;border-bottom:1px solid #f0f0f0;">&#10003;&nbsp;&nbsp;Ongoing Supplier Relationship Management</li>
            <li style="padding:6px 0;color:#333;font-size:14px;border-bottom:1px solid #f0f0f0;">&#10003;&nbsp;&nbsp;Quarterly Sourcing Review</li>
            <li style="padding:6px 0;color:#333;font-size:14px;border-bottom:1px solid #f0f0f0;">&#10003;&nbsp;&nbsp;Priority Response Ahead of Ad-Hoc Work</li>
            <li style="padding:6px 0;color:#333;font-size:14px;">&#10003;&nbsp;&nbsp;No Minimum Term — 30 Days’ Notice</li>
          </ul>
          <button type="button" data-vds-inquiry="Sourcing Partner Retainer" style="background:#1a2a4a;color:#fff;border:none;padding:14px 30px;border-radius:6px;font-size:14px;font-weight:600;cursor:pointer;">Discuss the Sourcing Partner Retainer &rarr;</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!--== SECTION 2: On-the-Ground Execution Services ==-->
<section style="background:#1a2a4a;padding:90px 0;">
  <div class="container">
    <div style="text-align:center;margin-bottom:60px;">
      <p style="color:#e8693c;font-weight:700;font-size:12px;letter-spacing:2px;text-transform:uppercase;margin-bottom:10px;">ON-THE-GROUND EXECUTION</p>
      <h2 style="color:#fff;font-size:38px;font-weight:800;margin-bottom:16px;">Additional Execution Services</h2>
      <p style="color:rgba(255,255,255,0.7);max-width:580px;margin:0 auto;font-size:16px;line-height:1.8;">Standalone services available independently or as part of a broader sourcing engagement.</p>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-12 mb-40">
        <div style="border-radius:12px;overflow:hidden;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.12);height:100%;display:flex;flex-direction:column;">
          <img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Factory-Tours.png" alt="Tailored Factory Tours — visiting Vietnam manufacturers with bilingual guide" style="width:100%;height:260px;object-fit:cover;display:block;">
          <div style="padding:36px;flex:1;display:flex;flex-direction:column;">
            <p style="color:#e8693c;font-weight:700;font-size:12px;letter-spacing:2px;text-transform:uppercase;margin-bottom:8px;">SERVICE A</p>
            <h3 style="color:#fff;font-size:26px;font-weight:700;margin-bottom:10px;">Tailored Factory Tours</h3>
            <p style="color:rgba(255,255,255,0.7);font-style:italic;font-size:15px;margin-bottom:16px;font-weight:500;">Inspect facilities, build relationships, and negotiate face-to-face.</p>
            <p style="color:rgba(255,255,255,0.65);font-size:14px;line-height:1.85;margin-bottom:22px;flex:1;">Establish long-term strategic relationships by walking the factory floors yourself. We build custom, highly-efficient itineraries tailored to your specific industry. Our bilingual industrial guides accompany you to handle cultural nuances, logistics, and real-time translation during hard business negotiations.</p>
            <ul style="list-style:none;padding:0;margin:0 0 26px;">
              <li style="padding:6px 0;color:rgba(255,255,255,0.7);font-size:14px;border-bottom:1px solid rgba(255,255,255,0.08);">&#10003;&nbsp;&nbsp;Customized Multi-Factory Itineraries</li>
              <li style="padding:6px 0;color:rgba(255,255,255,0.7);font-size:14px;border-bottom:1px solid rgba(255,255,255,0.08);">&#10003;&nbsp;&nbsp;Bilingual Technical Translators</li>
              <li style="padding:6px 0;color:rgba(255,255,255,0.7);font-size:14px;border-bottom:1px solid rgba(255,255,255,0.08);">&#10003;&nbsp;&nbsp;Pre-Verified Production Suitability</li>
              <li style="padding:6px 0;color:rgba(255,255,255,0.7);font-size:14px;">&#10003;&nbsp;&nbsp;Local Transportation &amp; Logistics Handling</li>
            </ul>
            <button type="button" data-vds-inquiry="Book a Tailored Factory Tour" style="background:#e8693c;color:#fff;border:none;padding:14px;border-radius:6px;font-size:14px;font-weight:600;cursor:pointer;width:100%;">Book a Tailored Factory Tour &rarr;</button>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 mb-40">
        <div style="border-radius:12px;overflow:hidden;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.12);height:100%;display:flex;flex-direction:column;">
          <img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/06/Quality-Assurance.png" alt="Rigorous Quality Assurance — third party inspection of manufactured goods in Vietnam" style="width:100%;height:260px;object-fit:cover;display:block;">
          <div style="padding:36px;flex:1;display:flex;flex-direction:column;">
            <p style="color:#e8693c;font-weight:700;font-size:12px;letter-spacing:2px;text-transform:uppercase;margin-bottom:8px;">SERVICE B</p>
            <h3 style="color:#fff;font-size:26px;font-weight:700;margin-bottom:10px;">Rigorous Quality Assurance</h3>
            <p style="color:rgba(255,255,255,0.7);font-style:italic;font-size:15px;margin-bottom:16px;font-weight:500;">International compliance standards verified independently on-site.</p>
            <p style="color:rgba(255,255,255,0.65);font-size:14px;line-height:1.85;margin-bottom:22px;flex:1;">Do not leave quality to chance. Partnered with a leading international third-party Quality Assurance firm, we conduct objective, strict audits right at the factory machines. From raw material verification to final container loading inspections, we ensure your goods meet precise technical blueprints.</p>
            <ul style="list-style:none;padding:0;margin:0 0 26px;">
              <li style="padding:6px 0;color:rgba(255,255,255,0.7);font-size:14px;border-bottom:1px solid rgba(255,255,255,0.08);">&#10003;&nbsp;&nbsp;Independent Pre-Shipment Inspections</li>
              <li style="padding:6px 0;color:rgba(255,255,255,0.7);font-size:14px;border-bottom:1px solid rgba(255,255,255,0.08);">&#10003;&nbsp;&nbsp;ISO/Social Compliance Factory Audits</li>
              <li style="padding:6px 0;color:rgba(255,255,255,0.7);font-size:14px;border-bottom:1px solid rgba(255,255,255,0.08);">&#10003;&nbsp;&nbsp;Lab Testing &amp; Certification Procedures</li>
              <li style="padding:6px 0;color:rgba(255,255,255,0.7);font-size:14px;">&#10003;&nbsp;&nbsp;Defect Sorting &amp; Corrective Action Plans</li>
            </ul>
            <button type="button" data-vds-inquiry="Schedule a Quality Inspection" style="background:#e8693c;color:#fff;border:none;padding:14px;border-radius:6px;font-size:14px;font-weight:600;cursor:pointer;width:100%;">Schedule a Quality Inspection &rarr;</button>
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
            <div class="trustindex-area py-5" style="min-height:850px;">
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