export default function MenuAccount(menuElement, menuBalance) {

  async function sendFormData(formData) {
    const url = `http://localhost/financy/account/create`;

    const response = await fetch(url, {
      method: 'POST',
      body: formData
    });

    // Handle fetch errors
    if (!response.ok) {
      const message = `An error has occured: ${response.status}`;
      throw new Error(message);
    }

    return await response.json();
  }

  function showFeedbacks(formElement, feedbacks) {
    for (const feedback of feedbacks) {
      const feedbackElement = formElement.querySelector(`.${feedback.element}`);
      const message = feedback.message;

      if (feedback.element === 'success') {
        formElement.reset();
      }

      feedbackElement.innerText = message;
      feedbackElement.style.display = 'block';
    }
  }

  function getInputElements(formElement) {
    const fields = formElement.querySelectorAll('.field-list .item');
    let inputElements = [];

    for (const field of fields) {
      inputElements.push(field.children[1]);
    }

    return inputElements;
  }

  function hideFeedbackOnClick(formElement) {
    const inputElements = getInputElements(formElement);
    const successElement = formElement.querySelector('.valid-feedback');

    // Hide error feedback
    for (const input of inputElements) {
      const errorElement = input.nextElementSibling;

      input.addEventListener('click', () => { 
        errorElement.style.display = 'none'
      });
    }

    // Hide success feedback
    formElement.addEventListener('click', () => { 
      successElement.style.display = 'none'
    });
  }

  async function handleSubmit(event) {
    event.preventDefault();

    const formElement = event.target;
    const formData = new FormData(formElement);

    const response = await sendFormData(formData);
    const feedbacks = response.feedbacks;
    const lastAccountId = response.lastAccountId;

    showFeedbacks(formElement, feedbacks);

    // If lastAccountId exists, update "select element" of menuBalance
    if (lastAccountId) {
      menuBalance.updateSelect(lastAccountId);
    }
  }

  async function init(menuElement) {
    const formElement = menuElement.querySelector('form');

    formElement.addEventListener('submit', handleSubmit);

    hideFeedbackOnClick(formElement);
  }

  init(menuElement);
}