(function ($) {
  "use strict";

  // ==========================================
  //      Start Document Ready function
  // ==========================================
  $(document).ready(function () {
    // =========================== Dropdown menu Js Start =======================
    $(document).on("click", ".dropdown-menu", function (event) {
      event.stopPropagation();
    });

    // Remove Dropdown Menu
    $(document).on("click", ".close-dropdown", function () {
      $(".dropdown-menu").removeClass("show");
      $(".dropdown-btn").removeClass("show");
      $(".dropdown-btn").attr("aria-expanded", "false"); // Fixed: changed setAttribute to attr
    });
    // =========================== Dropdown menu Js End =======================

    // =========================== Submenu Open & Close Js Start =======================
    $(document).on("click", ".has-dropdown", function () {
      $(".has-dropdown").removeClass("activePage");
      $(".has-dropdown").not($(this)).find(".sidebar-submenu").slideUp(400);

      $(this).find(".sidebar-submenu").slideToggle(400);
      $(this).toggleClass("activePage");
    });

    // $('.sidebar-menu__item.activePage').find('.sidebar-submenu').slideDown(400);
    // =========================== Submenu Open & Close Js End =======================

    // ========================== add active class to ul>li top Active current page Js Start =====================
    function dynamicActiveMenuClass(selector) {
      let FileName = window.location.pathname.split("/").reverse()[0];

      selector.find("li").each(function () {
        let anchor = $(this).find("a");
        if ($(anchor).attr("href") == FileName) {
          $(this).addClass("activePage");
        }
      });
      // if any li has activePage element add class
      selector.children("li").each(function () {
        if ($(this).find(".activePage").length) {
          $(this).addClass("activePage");
        }
      });
      // if no file name return
      if ("" == FileName) {
        selector.find("li").eq(0).addClass("activePage");
      }
    }
    if ($("ul").length) {
      dynamicActiveMenuClass($("ul"));
    }
    // ========================== add active class to ul>li top Active current page Js End =====================

    //  =========================== Submenu Open & Active Dropdown menu while page active ========================
    if ($(".sidebar-menu__item").hasClass("activePage")) {
      $(".sidebar-menu__item.activePage")
        .find(".sidebar-submenu")
        .slideDown(400);
    }
    //  =========================== Submenu Open & Active Dropdown menu while page active End ========================

    //  =========================== Sidebar Open & Close Start ===============================
    $(document).on("click", ".toggle-btn", function () {
      $(".sidebar").addClass("active");
      $(".side-overlay").addClass("show");
    });

    $(document).on("click", ".side-overlay, .sidebar-close-btn", function () {
      $(".side-overlay").removeClass("show");
      $(".sidebar").removeClass("active");
    });
    //  =========================== Sidebar Open & Close End ===============================

    // =========================== Tooltip Js Start ===============================
    const tooltipTriggerList = document.querySelectorAll(
      '[data-bs-toggle="tooltip"]'
    );
    const tooltipList = [...tooltipTriggerList].map(
      (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
    );
    // =========================== Tooltip Js End ===============================

    // ============================= Image Upload Js Start ==============================
    $(function () {
      $("#fileUpload").fileUpload();
    });
    // ============================= Image Upload Js End ==============================

    // ============================= Text Counter Js Start ==============================
    $(document).on("input", ".text-counter", function () {
      const characterCount = $(this).val().length;
      console.log(characterCount);
      $("#current").text(characterCount);
    });
    // ============================= Text Counter Js End ==============================

    // ============================= Course Details Accordion Js Start ==============================
    $(document).on("click", ".course-item__button", function () {
      $(".course-item__button").not($(this)).removeClass("active");
      $(".course-item__button")
        .not($(this))
        .closest(".course-item")
        .find(".course-item-dropdown")
        .slideUp();

      $(this).toggleClass("active");
      $(this)
        .closest(".course-item")
        .find(".course-item-dropdown")
        .slideToggle();
    });

    $(".course-list__item.active .circle i").removeClass("ph ph-circle");
    $(".course-list__item.active .circle i").addClass(
      "ph-fill ph-check-circle text-main-600"
    );

    // ============================= Course Details Accordion Js End ==============================

    // ================== Password Show Hide Js Start ==========
    $(document).on("click", ".toggle-password", function () {
      $(this).toggleClass("active");
      var input = $($(this).attr("id"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
    // ========================= Password Show Hide Js End ===========================

    // ========================= Billing Radio Checked Js Start ===========================
    $(document).on(
      "change",
      ".form-check-input.payment-method-one",
      function () {
        $(".payment-method.payment-method-one").removeClass("active");
        $(this)
          .closest(".payment-method.payment-method-one")
          .addClass("active");
      }
    );

    $(document).on(
      "change",
      ".form-check-input.payment-method-two",
      function () {
        $(".payment-method.payment-method-two").removeClass("active");
        $(this)
          .closest(".payment-method.payment-method-two")
          .addClass("active");
      }
    );
    // ========================= Billing Radio Checked Js End ===========================

    // ========================= List Grid View Js Start ===========================
    $(".list-grid-view li.activePage").each(function () {
      var icon = $(this).find("a i");
      if (icon.hasClass("ph-rows")) {
        icon.removeClass("ph-rows").addClass("ph-fill ph-rows");
      } else if (icon.hasClass("ph-squares-four")) {
        icon.removeClass("ph-squares-four").addClass("ph-fill ph-squares-four");
      }
    });

    $(document).on("click", ".list-view-btn", function () {
      $(this).addClass("active");
      $(".grid-view-btn").removeClass("active");
      $(".list-view").removeClass("d-none");
      $(".grid-view").addClass("d-none");
    });

    $(document).on("click", ".grid-view-btn", function () {
      $(this).addClass("active");
      $(".list-view-btn").removeClass("active");
      $(".grid-view").removeClass("d-none");
      $(".list-view").addClass("d-none");
    });
    // ========================= List Grid View Js End ===========================

    // ========================= Toggle Search Box Js Start ===========================
    $(document).on("click", ".toggle-search-btn", function () {
      $(this).toggleClass("bg-main-600 border-main-600 text-white");
      $(".toggle-search-box").slideToggle();
    });
    // ========================= Toggle Search Box Js End ===========================
  });
  // ==========================================
  //      End Document Ready function
  // ==========================================

  // ========================= Preloader Js Start =====================
  $(window).on("load", function () {
    $(".preloader").fadeOut();
  });
  // ========================= Preloader Js End=====================

  // ========================= Header Sticky Js Start ==============
  $(window).on("scroll", function () {
    if ($(window).scrollTop() >= 260) {
      $(".header").addClass("fixed-header");
    } else {
      $(".header").removeClass("fixed-header");
    }
  });
  // ========================= Header Sticky Js End===================
})(jQuery);
