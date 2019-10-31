+function ($) { "use strict";

  function getData(name) {
    return $('#myDropdown').data(name);
  }
  let locales = getData('values');
  let activeLocale = getData('activelocale');
  let handlerFn = getData('request');
  let media = getData('media');
  let data = locales.map(el => {
    let { name, code, translatepics_picture } = el;
    return {
      text: name,
      value: code,
      selected: code == activeLocale,
      imageSrc: media + translatepics_picture
    };
  });
  $('#myDropdown').ddslick({
    data,
    width:120,
    // selectText: "Select your preferred social network",
    imagePosition:"left",
    onSelected: function(selectedData){
      let code = selectedData.selectedData.value;
      if (code && activeLocale !== code) {
        $('form#languageLocale').request(handlerFn, {
          data: {locale: code}
        });
      }
    }   
  });

}(window.jQuery);