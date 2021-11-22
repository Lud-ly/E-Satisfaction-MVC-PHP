<?php
class VueTest extends Vue
{
    protected function ajoutTest() {
        $contenu ='
            <div class="form-group">
                <button type="button" onclick="addEntity()" class="btn btn-primary">Add account</button>
            </div>
        ';
        return $contenu;
    }
}
