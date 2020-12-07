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

  function populateSelect(accounts, select) {
    for (const account of accounts) {
      const option = document.createElement("option");
  
      option.value = account.account_id;
      option.innerText = account.account_name;
  
      select.appendChild(option);
    }
  }

  function populateSelectCategory(categories, select) {
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

    const message = await response.json();
    return message;
  }

  async function handleSubmit(event) {
    event.preventDefault();

    const flow = event.target.dataset.flow;
    
    const formData = new FormData(event.target);
    formData.append('flow', flow);

    const message = await sendFormData(formData);
    
    console.log(message);
  } 

  async function init(modalElement) {
    const formElement = modalElement.querySelector('form'); 

    const accountSelect = formElement.querySelector('.accountSelect');
    const categorySelect = formElement.querySelector('.categorySelect');
    const flow = formElement.dataset.flow;

    const urlAccounts = `http://localhost/financy/addAccount/getAccounts`;
    const urlCategories = `http://localhost/financy/category/getCategories/${flow}`;

    const accounts = await fetchContent(urlAccounts);
    const categories = await fetchContent(urlCategories);

    populateSelect(accounts, accountSelect);
    populateSelectCategory(categories, categorySelect);

    formElement.addEventListener('submit', handleSubmit);
  }

  init(modalElement);
}