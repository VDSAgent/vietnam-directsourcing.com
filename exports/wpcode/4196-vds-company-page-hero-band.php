add_action( 'get_footer', function () {
    if ( 16 !== (int) get_queried_object_id() ) { return; }
    echo <<<'HTML'
<section class="vds-company-hero" style="background:#fff;padding:70px 20px 0;">
  <div style="text-align:center;">
    <p style="color:#e8693c;font-weight:700;font-size:12px;letter-spacing:2px;text-transform:uppercase;margin-bottom:10px;">VIETNAM SOURCING COMPANY</p>
    <h2 style="color:#1a2a4a;font-size:38px;font-weight:800;margin-bottom:16px;">Direct factory access, no hidden fees</h2>
    <p style="color:#666;max-width:620px;margin:0 auto;font-size:16px;line-height:1.8;">Over 25 years in Asian manufacturing — real factory visits, real quotes, production managed on the ground.</p>
  </div>
</section>
<section class="transport-area pt-100 pb-100 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60 vds-how-we-work">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-8">
        <div class="section-title text-center mb-60">
          <h2>How We Work: Your Vietnam Sourcing Process</h2>
          <p class="sect-title">From first factory match to container on the water — five steps, one sourcing agent in Vietnam.</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-4 col-lg-4 col-md-6">
        <div class="transport-wrapper mb-30">
          <div class="transport-img"><img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/10/supplier-identification.png" class="vds-info-image" alt="Supplier Identification and Vetting"></div>
          <div class="transport-content">
            <h3>Supplier Identification &amp; Vetting</h3>
            <p>We match your spec to vetted, export-ready factories — English-fluent, Western-standard communication from a team with 25 years on the ground in Asia.</p>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-6">
        <div class="transport-wrapper mb-30">
          <div class="transport-img"><img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/10/factory-audits.png" class="vds-info-image" alt="Factory Audits — 3 Regional Hubs"></div>
          <div class="transport-content">
            <h3>Factory Audits — 3 Regional Hubs</h3>
            <p>Staff based in Hanoi, Da Nang and HCMC mean on-site audits within 24 hours — not weeks of back-and-forth with a broker.</p>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-6">
        <div class="transport-wrapper mb-30">
          <div class="transport-img"><img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/10/factory-pricing.png" class="vds-info-image" alt="Zero-Markup Direct Factory Pricing"></div>
          <div class="transport-content">
            <h3>Zero-Markup Direct Factory Pricing</h3>
            <p>Multiple real quotes, no markup — flat-rate, pay-as-you-go, and you keep the original factory invoice.</p>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-6">
        <div class="transport-wrapper mb-30">
          <div class="transport-img"><img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/10/quality-control.png" class="vds-info-image" alt="Strict AQL 2.5 Quality Control"></div>
          <div class="transport-content">
            <h3>Strict AQL 2.5 Quality Control</h3>
            <p>Pre-shipment and in-line QC against AQL 2.5 international sampling standards, with photo and video evidence.</p>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-6">
        <div class="transport-wrapper mb-30">
          <div class="transport-img"><img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/10/production-management.png" class="vds-info-image" alt="Production Management"></div>
          <div class="transport-content">
            <h3>Production Management</h3>
            <p>We check in at the milestones that matter — kickoff, mid-run, and pre-shipment sign-off — not just at the handshake.</p>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-6">
        <div class="transport-wrapper mb-30">
          <div class="transport-img"><img src="https://vietnam-directsourcing.com/wp-content/uploads/2026/10/logistics-shipping.png" class="vds-info-image" alt="Logistics and Shipping"></div>
          <div class="transport-content">
            <h3>Logistics &amp; Shipping</h3>
            <p>FOB, CIF or door-to-door — containers tracked from the port to your warehouse.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<style>
main>.vds-company-hero{order:15}
main>section.vds-regions{order:16}
main>section.vds-team{order:17}
main>section.why-chose-us{display:none}
main>section.logistics-services{display:none}
main>.vds-how-we-work{order:50}
</style>
HTML;
} );