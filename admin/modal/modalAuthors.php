<!-- Add Author Modal -->
<div id="authorsModal" tabindex="-1" aria-hidden="true" class="fixed z-999 top-0 left-0 w-100 h-100 bg-black-80 dn">
    <div class="bg-white mw6 center mt5 pa4 br3">
        <div class="flex justify-between items-center mb4">
            <h3 class="f4">Tambah Author</h3>
            <button id="closeModalBtn" class="link dim black-80 f4">
                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24">
                    <path fill="none" stroke="#000" stroke-linecap="round" stroke-width="2" d="m3 3 18 18M21 3 3 21"></path>
                </svg>
            </button>
        </div>
        <form method="post">
            <div class="mv3">
                <label for="author" class="db mb2">Nama Author</label>
                <input type="text" id="author" name="author" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
            </div>
            <div>
                <button type="submit" name="create" class="f6 link dim br2 ph3 pv2 mb2 dib white bg-dark-blue">
                    Tambah Author
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Author Modal -->
<div id="authorsEditModal" tabindex="-1" aria-hidden="true" class="fixed z-999 top-0 left-0 w-100 h-100 bg-black-80 dn">
    <div class="bg-white mw6 center mt5 pa4 br3">
        <div class="flex justify-between items-center mb4">
            <h3 class="f4">Edit Author</h3>
            <button id="closeEditModalBtn" class="link dim black-80 f4">
                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24">
                    <path fill="none" stroke="#000" stroke-linecap="round" stroke-width="2" d="m3 3 18 18M21 3 3 21"></path>
                </svg>
            </button>
        </div>
        <form id="editForm" method="post">
            <div class="mv3">
                <label for="editAuthor" class="db mb2">Nama Author</label>
                <input type="text" id="editAuthor" name="author" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
            </div>
            <input type="hidden" id="editAthrid" name="athrid" value="">
            <div>
                <button type="submit" name="update" class="f6 link dim br2 ph3 pv2 mb2 dib white bg-dark-green">Update</button>
            </div>
        </form>
    </div>
</div>