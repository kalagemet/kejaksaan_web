<!-- Sharingbutton Facebook -->
<div class='row'>
    <div class="col-xl-3 col-md-6 mb-12 d-grid gap-2">
        <a data-aos="fade-up"
            href="https://facebook.com/sharer/sharer.php?u=<?php echo base_url("$_SERVER[REQUEST_URI]"); ?>"
            target="_blank" rel="noopener" aria-label="Share on Facebook"
            style="background-color:#3b5998;margin: 10px 0px;" class="btn btn-primary"><i class="bi bi-facebook"></i>
            Share on Facebook</a>
    </div>
    <div class="col-xl-3 col-md-6 mb-12 d-grid gap-2">
        <!-- Sharingbutton Twitter -->
        <a data-aos="fade-up"
            href="https://twitter.com/intent/tweet?text=<?php if(isset($page_title)) echo $page_title; ?>&amp;original_referer=<?php echo base_url("$_SERVER[REQUEST_URI]"); ?>"
            target="_blank" rel="noopener" aria-label="Share on Twitter"
            style="margin: 10px 0px;background-color:#00acee" class="btn btn-primary"><i class="bi bi-twitter"></i>
            Share on Twitter</a>
    </div>
    <div class="col-xl-3 col-md-6 mb-12 d-grid gap-2">
        <!-- Sharingbutton WhatsApp -->
        <a data-aos="fade-up"
            href="whatsapp://send?text=<?php if(isset($page_title)) echo $page_title; ?>%20<?php echo base_url("$_SERVER[REQUEST_URI]"); ?>"
            target="_blank" rel="noopener" aria-label="Share on WhatsApp"
            style="margin: 10px 0px;background-color:#128C7E" class="btn btn-primary"><i class="bi bi-whatsapp"></i>
            Share on WhatsApp</a>
    </div>
    <div class="col-xl-3 col-md-6 mb-12 d-grid gap-2">
        <!-- Sharingbutton Telegram -->
        <a data-aos="fade-up"
            href="https://telegram.me/share/url?text=<?php if(isset($page_title)) echo $page_title; ?>&amp;url=<?php echo base_url("$_SERVER[REQUEST_URI]"); ?>"
            target="_blank" rel="noopener" aria-label="Share on Telegram"
            style="margin: 10px 0px;background-color:#0088CC" class="btn btn-primary"><i class="bi bi-telegram"></i>
            Share on Telegram</a>
    </div>
</div>
<br />