<?php
/**
 * Plugin Name: OneTrust Text Overrides (WPML)
 * Description: Overrides OneTrust cookie banner texts using WPML translations.
 * Author: Vanik
 * Version: 1.0.0
 */

if (!defined('ABSPATH')) exit;

add_action('init', function () {
    $domain = 'onetrust-overrides';
    $strings = [
        'banner_title'       => 'Privacy Preference Center',
        'banner_description' => 'By clicking “Accept All Cookies”, you agree to the storing of cookies on your device to enhance site navigation, analyze site usage, and assist in our marketing efforts.',
        'btn_accept'         => 'Accept All Cookies',
        'btn_reject'         => 'Reject All',
        'btn_settings'       => 'Cookies Settings',
        'pc_confirm' => 'Confirm My Choices',
        'pc_title'           => 'Privacy Preference Center',
        'btn_settings_link' => 'Cookie Preferences',
        'pc_desc' => 'When you visit any website, it may store or retrieve information on your browser, mostly in the form of cookies. This information might be about you, your preferences or your device and is mostly used to make the site work as you expect it to. The information does not usually directly identify you, but it can give you a more personalized web experience. Because we respect your right to privacy, you can choose not to allow some types of cookies. Click on the different category headings to find out more and change our default settings. However, blocking some types of cookies may impact your experience of the site and the services we are able to offer',
        'cat_title  '=> 'Manage Consent Preferences',
        'pc_allow_all' => 'Allow All',
        'cat_C0001_header' => 'Strictly Necessary Cookies',
        'cat_C0001_desc'   => 'These cookies are necessary for the website to function and cannot be switched off in our systems. They are usually only set in response to actions made by you which amount to a request for services, such as setting your privacy preferences, logging in or filling in forms. You can set your browser to block or alert you about these cookies, but some parts of the site will not then work. These cookies do not store any personally identifiable information.',
        'cat_C0001_status' => 'Always Active',
        'cat_C0002_header' => 'Performance Cookies',
        'cat_C0002_desc'   => 'These cookies allow us to count visits and traffic sources so we can measure and improve the performance of our site. They help us to know which pages are the most and least popular and see how visitors move around the site. All information these cookies collect is aggregated and therefore anonymous. If you do not allow these cookies we will not know when you have visited our site, and will not be able to monitor its performance.',
        'cat_C0003_header' => 'Functional Cookies',
        'cat_C0003_desc'   => 'These cookies enable the website to provide enhanced functionality and personalisation. They may be set by us or by third party providers whose services we have added to our pages. If you do not allow these cookies then some or all of these services may not function properly.',
        'cat_C0004_header' => 'Targeting Cookies',
        'cat_C0004_desc'   => 'These cookies may be set through our site by our advertising partners. They may be used by those companies to build a profile of your interests and show you relevant adverts on other sites. They do not store directly personal information, but are based on uniquely identifying your browser and internet device. If you do not allow these cookies, you will experience less targeted advertising.',

    ];

    foreach ($strings as $name => $default) {
        if (function_exists('do_action')) {
            do_action('wpml_register_single_string', $domain, $name, $default);
        }
    }
});

/** Helper: get translated string or default */
function oto_get_text($name, $default) {
    if (function_exists('apply_filters')) {
        $translated = apply_filters('wpml_translate_single_string', $default, 'onetrust-overrides', $name);
        if (!empty($translated)) return $translated;
    }
    return $default;
}

add_action('wp_enqueue_scripts', function () {
    $data = [
        'title'   => oto_get_text('banner_title', 'Privacy Preference Center'),
        'desc'    => oto_get_text('banner_description', 'By clicking “Accept All Cookies”, you agree to the storing of cookies on your device to enhance site navigation, analyze site usage, and assist in our marketing efforts.'),
        'accept'  => oto_get_text('btn_accept', 'Accept All Cookies'),
        'reject'  => oto_get_text('btn_reject', 'Reject All'),
        'pcConfirm' => oto_get_text('pc_confirm', 'Confirm My Choices'),
        'settings'=> oto_get_text('btn_settings', 'Cookies Settings'),
        'pcTitle' => oto_get_text('pc_title', 'Privacy Preference Center'),
        'settingsLink'=> oto_get_text('btn_settings_link', 'Cookie Preferences'),
        'pcDesc'=> oto_get_text('pc_desc', 'When you visit any website, it may store or retrieve information on your browser, mostly in the form of cookies. This information might be about you, your preferences or your device and is mostly used to make the site work as you expect it to. The information does not usually directly identify you, but it can give you a more personalized web experience. Because we respect your right to privacy, you can choose not to allow some types of cookies. Click on the different category headings to find out more and change our default settings. However, blocking some types of cookies may impact your experience of the site and the services we are able to offer'),
        'catTitle'=> oto_get_text('cat_title', 'Cookie Preferences'),
        'pcAllow' => oto_get_text('pc_allow_all', 'Allow All'),
        'cats' => [
            'C0001' => [
                'header' => oto_get_text('cat_C0001_header', 'Strictly Necessary Cookies'),
                'desc'   => oto_get_text('cat_C0001_desc',   'These cookies are necessary for the website to function and cannot be switched off in our systems. They are usually only set in response to actions made by you which amount to a request for services, such as setting your privacy preferences, logging in or filling in forms. You can set your browser to block or alert you about these cookies, but some parts of the site will not then work. These cookies do not store any personally identifiable information.'),
                'status' => oto_get_text('cat_C0001_status', 'Always Active'),
            ],
            'C0002' => [
                'header' => oto_get_text('cat_C0002_header', 'Performance Cookies'),
                'desc'   => oto_get_text('cat_C0002_desc',   'These cookies allow us to count visits and traffic sources so we can measure and improve the performance of our site. They help us to know which pages are the most and least popular and see how visitors move around the site. All information these cookies collect is aggregated and therefore anonymous. If you do not allow these cookies we will not know when you have visited our site, and will not be able to monitor its performance.'),
            ],
            'C0003' => [
                'header' => oto_get_text('cat_C0003_header', 'Functional Cookies'),
                'desc'   => oto_get_text('cat_C0003_desc',   'These cookies enable the website to provide enhanced functionality and personalisation. They may be set by us or by third party providers whose services we have added to our pages. If you do not allow these cookies then some or all of these services may not function properly.'),
            ],
            'C0004' => [
                'header' => oto_get_text('cat_C0004_header', 'Targeting Cookies'),
                'desc'   => oto_get_text('cat_C0004_desc',   'These cookies may be set through our site by our advertising partners. They may be used by those companies to build a profile of your interests and show you relevant adverts on other sites. They do not store directly personal information, but are based on uniquely identifying your browser and internet device. If you do not allow these cookies, you will experience less targeted advertising.'),
            ],
        ],
    ];

    $script = <<<JS
(function(){
  var STR = %s;

  function setText(el, value){
    if (!el || !value) return false;
    if (el.textContent === value) return false; 
    el.textContent = value;
    return true;
  }

  function applyOnce(){
    var banner = document.getElementById('onetrust-banner-sdk');
    if (!banner) return false; 

    var changed = false;
    
    changed |= setText(document.getElementById('onetrust-accept-btn-handler'), STR.accept);
    changed |= setText(document.getElementById('onetrust-reject-all-handler'), STR.reject);
    changed |= setText(document.getElementById('onetrust-pc-btn-handler'),     STR.settings);
    changed |= setText(document.getElementById('ot-pc-desc'), STR.pcDesc);
    changed |= setText(document.getElementById('ot-category-title'), STR.catTitle);
    changed |= setText(document.getElementById('accept-recommended-btn-handler'), STR.pcAllow);
    
    document.querySelectorAll('.ot-pc-footer .save-preference-btn-handler')
      .forEach(function(el){ changed |= setText(el, STR.pcConfirm); });
    
    document.querySelectorAll('.ot-pc-footer .ot-pc-refuse-all-handler, #reject-all-handler')
      .forEach(function(el){ changed |= setText(el, STR.reject); });
    
    document.querySelectorAll('.ot-pc-footer .accept-recommended-btn-handler')
      .forEach(function(el){ changed |= setText(el, STR.pcAllow); })
    
    if (STR.cats){
      for (var code in STR.cats){
        if (!Object.prototype.hasOwnProperty.call(STR.cats, code)) continue;
        var cat = STR.cats[code] || {};
        if (cat.header) setText(document.getElementById('ot-header-id-' + code), cat.header);
        if (cat.desc)   setText(document.getElementById('ot-desc-id-' + code),   cat.desc);
        if (cat.status) setText(document.getElementById('ot-status-id-' + code), cat.status);
      }
    }
    
    var linkText = STR.settingsLink || STR.settings;
    var triggers = document.querySelectorAll('#ot-sdk-btn, #ot-sdk-btn-floating, #ot-sdk-btn-mobile, .ot-sdk-show-settings');
    triggers.forEach(function(el){ changed |= setText(el, linkText); });

    var title =
      document.querySelector('#onetrust-policy-title') ||
      document.querySelector('#onetrust-banner-sdk .banner-title, #onetrust-banner-sdk h2');
    changed |= setText(title, STR.title);

    var desc = document.getElementById('onetrust-policy-text');
    if (desc && STR.desc){
      if (desc.children.length === 0){
        changed |= setText(desc, STR.desc);
      } else {
        var tn = Array.from(desc.childNodes).find(function(n){return n.nodeType===3;});
        if (tn && tn.nodeValue !== STR.desc){ tn.nodeValue = STR.desc; changed = true; }
      }
    }

    var pcTitle = document.querySelector('#ot-pc-title, #onetrust-pc-sdk h3');
    changed |= setText(pcTitle, STR.pcTitle);

    return changed;
  }

  var debounceTimer = null;
  function scheduleApply(){
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(applyOnce, 60);
  }

  function observe(node){
    if (!node) return;
    try{
      var mo = new MutationObserver(function(){ scheduleApply(); });
      mo.observe(node, {childList:true, subtree:true, characterData:true});
    }catch(e){}
  }

  var prev = window.OptanonWrapper;
  window.OptanonWrapper = function(){
    if (typeof prev === 'function') { try { prev(); } catch(e){} }
    applyOnce();
    observe(document.getElementById('onetrust-banner-sdk'));
    observe(document.getElementById('onetrust-pc-sdk'));
  };

  document.addEventListener('DOMContentLoaded', function(){
    var tries = 0;
    var iv = setInterval(function(){
      if (applyOnce() || ++tries > 8) clearInterval(iv);
    }, 300);
  });
})();
JS;

    wp_add_inline_script('jquery-core', sprintf($script, wp_json_encode($data)), 'after');
}, 999);
