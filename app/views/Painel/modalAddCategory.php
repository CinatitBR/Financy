<div 
  class="modal fade" 
  id="modal_add_category" 
>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" style="color: var(--brown);">
          Adicionar categoria
        </h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="#" id="form_add_category">
        <div class="modal-body">

          <div class="success valid-feedback"></div>
          <div class="database-error invalid-feedback"></div>

          <div class="field-list">

            <div class="item">
              <label for="name_add_category">Nome da categoria</label>

              <input 
                type="text" 
                name="category" 
                id="name_add_category" 
                maxlength="100" 
                required 
              />

              <div class="category-name-error invalid-feedback"></div>
            </div>

            <div class="item">
              <label for="flow_add_category">Tipo da categoria</label>

              <select name="flow" id="flow_add_category">
                <option value="E">Ganho</option>
                <option value="S">Despesa</option>
              </select>

              <div class="category-flow-error invalid-feedback"></div>
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