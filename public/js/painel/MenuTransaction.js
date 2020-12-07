export default function MenuTransaction(modalElement) {

  const selectAccount = modalElement.querySelector('.selectAccount');
  const selectCategory = modalElement.querySelector('.selectCategory');
  const formElement = modalElement.querySelector('form');
  const flow = formElement.dataset.flow;

  const urlAccounts = `http://localhost/financy/addAccount/getAccounts`;
  const urlCategories = `http://localhost/financy/category/getCategories/${flow}`;

  function fetchAccounts(urlAccounts) {
    return fetch(urlAccounts)
      .then(response => response.json())
  }

  function populateSelect(accounts, select) {
    for (const account of accounts) {
      const option = document.createElement("option");
  
      option.value = account.account_id;
      option.innerText = account.account_name;
  
      select.appendChild(option);
    }
  }

  function fetchCategories(urlCategories) {
    return fetch(urlCategories)
      .then(response => response.json())
  }

  function populateSelectCategory(categories, select) {
    for (const category of categories) {
      const option = document.createElement("option");
  
      option.value = category.category_id;
      option.innerText = category.category;
  
      select.appendChild(option);
    }
  }

  async function sendData(formData) {
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
    console.log(message);
  }

  fetchAccounts(urlAccounts)
    .then(accounts => populateSelect(accounts, selectAccount))
    .catch(error => console.log(error));
  
  fetchCategories(urlCategories)
    .then(categories => populateSelectCategory(categories, selectCategory))
    .catch(error => console.log(error));
  
  formElement.addEventListener('submit', (event) => {
    event.preventDefault();
    
    const formData = new FormData(event.target);

    const flow = event.target.dataset.flow;
    formData.append('flow', flow);

    sendData(formData);
  });
}