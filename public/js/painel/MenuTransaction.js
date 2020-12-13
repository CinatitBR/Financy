export default function MenuTransaction(modalElement, paymentTable, form) {

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

  async function handleSubmit(event) {
    event.preventDefault();

    const formElement = event.target;
    const formData = new FormData(formElement);
    const flow = formElement.dataset.flow;

    formData.append('flow', flow);

    const url = `http://localhost/financy/payment/create`;
    const response = await form.sendFormData(formData, url);

    const feedbacks = response.feedbacks;
    const lastPaymentId = response.lastPaymentId;

    form.showFeedbacks(formElement, feedbacks);

    // If lastPaymentId exists, update payment table
    if (lastPaymentId) {
      paymentTable.updateTable(lastPaymentId);
    }
  } 

  async function init() {
    const formElement = modalElement.querySelector('form'); 

    const accountSelect = formElement.querySelector('.accountSelect');
    const categorySelect = formElement.querySelector('.categorySelect');
    const flow = formElement.dataset.flow;

    const urlAccounts = `http://localhost/financy/account/getAccounts`;
    const urlCategories = `http://localhost/financy/category/getCategories/${flow}`;

    const accounts = await form.fetchContent(urlAccounts);
    const categories = await form.fetchContent(urlCategories);

    populateAccountSelect(accounts, accountSelect);
    populateCategorySelect(categories, categorySelect);

    formElement.addEventListener('submit', handleSubmit);

    form.hideFeedbackOnClick(formElement);
  }

  init();
}