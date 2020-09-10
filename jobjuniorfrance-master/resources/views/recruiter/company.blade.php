<fieldset class="border p-4">
    <legend class="w-auto text-center p-3 blue-title">Entreprise</legend>

    <div class="form-group mt-4">
        <label for="company_email">E-mail de l'entreprise *  ( Celui-ci reste privé, il ne sert que pour la facturation et l'édition de la fiche)</label>
        <input type="email" class="form-control" id="company_email" aria-describedby="company_email" name="company_email" value="{{ old('company_email') }}" required>
    </div>
    <div class="form-group mt-4">
        <label for="invoice_address">Adresse de facturation</label>
        <input type="text" class="form-control" id="invoice_address" aria-describedby="invoice_address" name="invoice_address" placeholder="Numéro de Rue, Rue, Bâtiment, Ville , Code postal" value="{{ old('invoice_address') }}" required>
    </div>
    <div class="row mt-4">
        <div class="col-12 col-md-12 col-lg-6">
            <label for="company_bank_card">Carte bancaire de l'entreprise</label>
            <div id="card-element">
                    <!-- A Stripe Element will be inserted here. -->
                </div>
                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert"></div>
        </div>
        <div class="col-12 col-md-12 col-lg-6">
                <label for="info_payment">&nbsp;</label>
            <p>Le paiement est <strong>sécurisé</strong> et <strong>garanti</strong> par Stripe, en HTTPS</p>
            <p>Le paiement se fera seulement au moment où vous cliquerez sur le bouton "Mettre en ligne"</p>
        </div>
    </div>


</fieldset>


