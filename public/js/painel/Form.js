export default function Form() {

  this.fetchContent = async (url) => {
    const response = await fetch(url);

     // Handle fetch errors
    if (!response.ok) {
      const message = `An error has occured: ${response.status}`;
      throw new Error(message);
    }

    return await response.json();
  }

  this.sendFormData = async (formData, url) => {
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

  this.showFeedbacks = (formElement, feedbacks) => {
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

  this.getInputElements = (formElement) => {
    const fields = formElement.querySelectorAll('.field-list .item');
    let inputElements = [];

    for (const field of fields) {
      inputElements.push(field.children[1]);
    }

    return inputElements;
  }

  // Hide feedback on clicking the input
  this.hideFeedbackOnClick = (formElement) => {
    const inputElements = this.getInputElements(formElement);
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
}