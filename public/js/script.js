document.addEventListener('DOMContentLoaded', function () {

  const toggle = document.getElementById('userMenuToggle');
  const dropdown = document.getElementById('userDropdown');

  toggle.addEventListener('click', function () {
    dropdown.classList.toggle('open');

    const arrow = document.querySelector('.top-user-arrow');
    arrow.textContent = dropdown.classList.contains('open') ? '∧' : '∨';
  });

  document.addEventListener('click', function (e) {
    if (!toggle.contains(e.target) && !dropdown.contains(e.target)) {
      dropdown.classList.remove('open');
    }
  });

});

document.addEventListener('DOMContentLoaded', function () {

  const hoverImages = document.querySelectorAll('.js-hover-img');

  hoverImages.forEach(img => {

    const defaultSrc = img.dataset.default;
    const hoverSrc = img.dataset.hover;

    img.addEventListener('mouseenter', () => {
      img.src = hoverSrc;
    });

    img.addEventListener('mouseleave', () => {
      img.src = defaultSrc;
    });

  });

  // 削除確認モーダル
  const deleteModal = document.getElementById('deleteModal');
  const deleteModalOk = document.getElementById('deleteModalOk');
  const deleteModalCancel = document.getElementById('deleteModalCancel');
  const deleteTriggers = document.querySelectorAll('.js-delete-trigger');

  let targetDeleteForm = null;

  deleteTriggers.forEach(trigger => {
    trigger.addEventListener('click', function (event) {
      event.preventDefault();

      targetDeleteForm = trigger.closest('.js-delete-form');

      if (deleteModal) {
        deleteModal.classList.add('open');
      }
    });
  });

  if (deleteModalOk) {
    deleteModalOk.addEventListener('click', function () {
      if (targetDeleteForm) {
        targetDeleteForm.submit();
      }
    });
  }

  if (deleteModalCancel) {
    deleteModalCancel.addEventListener('click', function () {
      if (deleteModal) {
        deleteModal.classList.remove('open');
      }
      targetDeleteForm = null;
    });
  }

  if (deleteModal) {
    deleteModal.addEventListener('click', function (event) {
      if (event.target === deleteModal) {
        deleteModal.classList.remove('open');
        targetDeleteForm = null;
      }
    });
  }
});
