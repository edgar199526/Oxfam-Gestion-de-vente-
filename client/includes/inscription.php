<div class="modal fade" id="inscriptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Inscrivez-vous pour pouvoir acheter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form class="row" method="post" action="<?= $app_url ?>client/traitements/inscription.php">

          <div class="col-6">
            <div class="form-group">
              <label for="nom" class="col-form-label">Noms:</label>
              <input type="text" class="form-control" id="nom" name="nom">
            </div>
            <div class="form-group">
              <label for="email" class="col-form-label">Email:</label>
              <input type="text" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
              <label for="telephone" class="col-form-label">Telephone:</label>
              <input type="text" class="form-control" id="telephone" name="telephone">
            </div>
           
          </div>
          
          <div class="col-6">
            <div class="form-group">
              <label for="cp" class="col-form-label">Code postal:</label>
              <input type="text" class="form-control" id="cp" name="cp">
            </div>
            <div class="form-group">
              <label for="ville" class="col-form-label">Ville :</label>
              <input type="text" class="form-control" id="ville" name="ville">
            </div>
            <div class="form-group">
              <label for="adresse" class="col-form-label">Adresse:</label>
              <input type="text" class="form-control" id="adresse" name="adresse">
            </div>
          </div>

          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Je m'inscris</button>
      </div>
      
        </form>
      </div>
      
    </div>
  </div>
</div>