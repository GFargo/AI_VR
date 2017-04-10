const $ = require('jquery');

// function flush() {
//   console.log('flushing...');
//   // document.querySelector('a-entity').components.position.flushToDOM();  // Flush a component.
//   // document.querySelector('a-entity').flushToDOM();  // Flush an entity.
//   // document.querySelector('a-entity').flushToDOM(true);  // Flush an entity and its children.
//   // document.querySelector('a-scene').flushToDOM(true);  // Flush every entity.
//   // document.querySelector('a-scene').reload();  // Flush every entity.
// }

$(() => {
  document.querySelector('a-scene').pause();
  $('body').removeClass('a-body');

  $('.ai-vr-toggle-scene a').click(function (event) {
    event.preventDefault();

    if ($('#ai-vr-scene-container').hasClass('visible')) {
      $(this).text('Open');
      document.querySelector('a-scene').pause();
      $('body').removeClass('a-body');
    } else {
      $(this).text('Close');
      $('body').addClass('a-body');
      document.querySelector('a-node').load();
      document.querySelector('a-scene').play();
    }

    $('#ai-vr-scene-container').toggleClass('visible');
  });
});
