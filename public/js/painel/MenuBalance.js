export default function MenuBalance(menuBalance) {

  const elementSelect = menuBalance.querySelector('#selectAccount');
  const url = `http://localhost/financy/addAccount/getAccounts`;

  function fetchAccounts(url) {
    return fetch(url)
      .then(response => {
        return response.json();
      })
  }

  // Populate select with accounts
  function populateSelect(accounts, elementSelect) {
    for (const account of accounts) {
      const option = document.createElement("option");
  
      option.value = account.balance;
      option.innerText = account.account_name;
  
      elementSelect.appendChild(option);
    }
  }

  // Show balance of selected account
  function showBalance(event) {
    const menuContent = menuBalance.querySelector('.menu-content');
    const balance = event.target.value;
  
    menuContent.innerText = `R$ ${balance}`;
  }

  elementSelect.addEventListener('change', showBalance);

  // Populate the select and fires showBalance event
  fetchAccounts(url)
    .then(accounts => populateSelect(accounts, elementSelect))
    .then(() => {
      // Force the event to trigger
      const event = new Event('change');

      elementSelect.dispatchEvent(event);
    })
    .catch(error => console.log(error));
}
