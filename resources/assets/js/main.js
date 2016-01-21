  var Disclosure = function(el, options) {
    el.isActive = false;
    el.details = el.querySelectorAll('[data-details]');
    el.hide = function() {
      for (var i = 0; i < el.details.length; i++) {
        el.details[i].style.display = 'none';
      }
    };
    el.show = function() {
      for (var i = 0; i < el.details.length; i++) {
        el.details[i].style.display = 'block';
      }
    };
    el.toggle = function(e) {
      e.stopPropagation();
      el.isActive = !el.isActive;
      if (el.isActive) {
        el.show();
      } else {
        el.hide();
      }
    }
    el.addEventListener('click', function(e) {
      el.toggle(e);
    });
    el.hide();
    return el;
  };

  var disclosures = document.querySelectorAll('[data-disclosure]');

  for (var i = 0; i < disclosures.length; i++) {
    disclosures[i] = new Disclosure(disclosures[i]);
  }