<!-- Modal Tambah -->
<div id="categoryModal" class="fixed z-999 top-0 left-0 w-100 h-100 bg-black-80 dn">
    <div class="bg-white mw6 center mt5 pa4 br3">
        <div class="flex justify-between items-center">
            <h3 class="f4">Tambah Kategori</h3>
            <button id="closeModalBtn" class="link dim black-80 f4">
                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24">
                    <path fill="none" stroke="#000" stroke-linecap="round" stroke-width="2" d="m3 3 18 18M21 3 3 21"></path>
                </svg>
            </button>
        </div>
        <form method="post">
            <div class="mv3">
                <label for="category" class="db mb2">Nama Kategori</label>
                <input type="text" name="category" id="category" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
            </div>
            <div class="mv3">
                <label for="status" class="db mb2">Status</label>
                <label class="pa2">
                    <input type="radio" name="status" value="1" checked> Active
                </label>
                <label class="pa2">
                    <input type="radio" name="status" value="0"> Inactive
                </label>
            </div>
            <div class="mv3">
                <button type="submit" name="create" class="f6 link dim br2 ph3 pv2 mb2 dib white bg-dark-blue">Tambah Kategori</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editCategoryModal" tabindex="-1" aria-hidden="true" class="fixed z-999 top-0 left-0 w-100 h-100 bg-black-80 dn">
    <div class="bg-white mw6 center mt5 pa4 br3">
        <div class="flex justify-between items-center mb4">
            <h3 class="f4">Edit Kategori</h3>
            <button id="closeEditModalBtn" class="link dim black-80 f4">
                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24">
                    <path fill="none" stroke="#000" stroke-linecap="round" stroke-width="2" d="m3 3 18 18M21 3 3 21"></path>
                </svg>
            </button>
        </div>
        <form id="editCategoryForm" method="post">
            <div class="mv3">
                <label for="category" class="db mb2">Kategori</label>
                <input type="text" id="editCategory" name="category" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
            </div>
            <div class="mb3">
                <label class="db mb1">Status</label>
                <div>
                    <label>
                        <input type="radio" name="status" id="statusActive" value="1" class="mr2">Active
                    </label>
                    <label>
                        <input type="radio" name="status" id="statusInactive" value="0" class="ml2">Inactive
                    </label>
                </div>
            </div>
            <input type="hidden" id="catid" name="catid" value="">
            <div>
                <button type="submit" name="update" class="f6 link dim br2 ph3 pv2 mb2 dib white bg-dark-green">Update</button>
            </div>
        </form>
    </div>
</div>