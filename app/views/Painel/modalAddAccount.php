<!-- Modal - Adicionar conta -->
<div 
  class="modal fade" 
  id="addAccount" 
>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" style="color: var(--brown);">Adicionar conta</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?php echo URLROOT; ?>/painel/addAccount" method="POST" >

        <div class="modal-body">

          <div class="field-list">

            <div class="item">
              <label for="inputContaNome">Digite o nome da sua conta:</label>

              <input type="text" name="accountName" id="inputContaNome" required>
            </div>

            <div class="item">
              <label for="inputValor">Digite o valor inicial da sua conta:</label>

              <div class="input-group">
                <input 
                  type="text" 
                  class="form-control money" 
                  name="value"
                  aria-label="Amount (to the nearest dollar)" 
                  step="0.01"
                  id="inputValor"
                  style="width: initial;"
                  required
                >
              </div>
            </div>

          </div>

        </div>

        <div class="modal-footer">
          <button 
            type="button" 
            class="btn btn-secondary" 
            data-dismiss="modal"
          >
            Fechar
          </button>

          <button type="submit" class="btn btn-primary">Adicionar</button>
        </div>

      </form>

    </div>
  </div>
</div>