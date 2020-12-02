const selectAccount = document.querySelector("#selectAccount");
const menuContent = document.querySelector(".menu-balance .menu-content");

const url = `http://localhost/financy/addAccount/getAccounts`;

fetch(url)
  .then(response => {
    return response.json();
  })
  .then(accounts => { 
    populateSelect(accounts);
  })
  .then(() => {
    showBalance();
  })
  .catch(error => console.log(error));

selectAccount.addEventListener('change', showBalance);

function populateSelect(accounts) {
  for (account of accounts) {
    const option = document.createElement("option");

    option.value = account.balance;
    option.innerText = account.account_name;

    selectAccount.appendChild(option);
  }
}

function showBalance() {
  const balance = selectAccount.value;

  menuContent.innerText = `R$ ${balance}`;
}