export default function MenuTransaction(modalElement) {

  async function fetchContent(url) {
    const response = await fetch(url);

    // Handle fetch errors
    if (!response.ok) {
      const message = `An error has occured: ${response.status}`;
      throw new Error(message);
    }

    return await response.json();
  }

  function populateAccountSelect(accounts, select) {
    for (const account of accounts) {
      const option = document.createElement("option");
  
      option.value = account.account_id;
      option.innerText = account.account_name;
  
      select.appendChild(option);
    }
  }

  function populateCategorySelect(categories, select) {
    for (const category of categories) {
      const option = document.createElement("option");
  
      option.value = category.category_id;
      option.innerText = category.category;
  
      select.appendChild(option);
    }
  }

  async function sendFormData(formData) {
    const url = `http://localhost/financy/transaction/create`;

    const response = await fetch(url, { 
      method: 'POST', 
      body: formData 
    });

    // Handle fetch errors
    if (!response.ok) {
      const message = `An error has occured: ${response.status}`;
      throw new Error(message);
    }

    const feedbacks = await response.json();
    return feedbacks;
  }

  function showFeedbacks(feedbacks, formElement) {    
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

  // Hide feedback on clicking the input
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

    const flow = formElement.dataset.flow;
    formData.append('flow', flow);

    const feedbacks = await sendFormData(formData);

    showFeedbacks(feedbacks, formElement);
    hideFeedbackOnClick(formElement);
  } 

  async function init(modalElement) {
    const formElement = modalElement.querySelector('form'); 

    const accountSelect = formElement.querySelector('.accountSelect');
    const categorySelect = formElement.querySelector('.categorySelect');
    const flow = formElement.dataset.flow;

    const urlAccounts = `http://localhost/financy/account/getAccounts`;
    const urlCategories = `http://localhost/financy/category/getCategories/${flow}`;

    const accounts = await fetchContent(urlAccounts);
    const categories = await fetchContent(urlCategories);

    populateAccountSelect(accounts, accountSelect);
    populateCategorySelect(categories, categorySelect);

    formElement.addEventListener('submit', handleSubmit);
  }

  init(modalElement);
}