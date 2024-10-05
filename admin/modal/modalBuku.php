<!-- Add Book Modal -->
<div id="bookModal" class="fixed z-999 top-0 left-0 w-100 h-100 bg-black-80 dn">
    <div class="bg-white mw6 center mt5 pa4">
        <div class="flex justify-between items-center">
            <h3 class="f4">Tambah Buku</h3>
            <button id="closeModalBtn" class="link dim black-80 f4">
                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24">
                    <path fill="none" stroke="#000" stroke-linecap="round" stroke-width="2" d="m3 3 18 18M21 3 3 21"></path>
                </svg>
            </button>
        </div>
        <form method="post" enctype="multipart/form-data">
            <div class="mv3">
                <label for="bookname" class="db mb2">Nama Buku</label>
                <input type="text" name="bookname" id="bookname" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
            </div>
            <div class="mv3">
                <label for="category" class="db mb2">Kategori</label>
                <select name="category" id="category" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    <?php
                    $status = 1;
                    $sql = "SELECT * FROM tblcategory WHERE Status=:status";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':status', $status, PDO::PARAM_STR);
                    $query->execute();
                    $categories = $query->fetchAll(PDO::FETCH_OBJ);
                    foreach ($categories as $category) { ?>
                        <option value="<?php echo htmlentities($category->id); ?>"><?php echo htmlentities($category->CategoryName); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mv3">
                <label for="author" class="db mb2">Author</label>
                <select name="author" id="author" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
                    <option value="" disabled selected>Pilih Author</option>
                    <?php
                    $sql = "SELECT * FROM tblauthors";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $authors = $query->fetchAll(PDO::FETCH_OBJ);
                    foreach ($authors as $author) { ?>
                        <option value="<?php echo htmlentities($author->id); ?>"><?php echo htmlentities($author->AuthorName); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mv3">
                <label for="isbn" class="db mb2">Nomor ISBN</label>
                <input type="text" name="isbn" id="isbn" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
            </div>
            <div class="mv3">
                <label for="price" class="db mb2">Harga</label>
                <input type="text" name="price" id="price" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
            </div>
            <div class="mv3">
                <label for="bookcover" class="db mb2">Book Cover</label>
                <input type="file" name="bookcover" id="bookcover" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
            </div>
            <div class="mv3">
                <button type="submit" name="add" class="f6 link dim br2 ph3 pv2 mb2 dib white bg-dark-blue">Tambah Buku</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Book Modal -->
<div id="editBookModal" class="fixed z-999 top-0 left-0 w-100 h-100 bg-black-80 dn">
    <div class="bg-white mw6 center mt5 pa4 br3">
        <div class="flex justify-between items-center">
            <h3 class="f4">Edit Book</h3>
            <button id="closeEditModalBtn" class="link dim black-80 f4">
                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24">
                    <path fill="none" stroke="#000" stroke-linecap="round" stroke-width="2" d="m3 3 18 18M21 3 3 21"></path>
                </svg>
            </button>
        </div>
        <form role="form" method="post" action="manage-books.php" enctype="multipart/form-data">
            <input type="hidden" name="bookid" id="editBookId">
            <div class="mv3">
                <label for="editBookName" class="db mb2">Nama Buku</label>
                <input type="text" name="bookname" id="editBookName" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
            </div>
            <div class="mv3">
                <label for="editCategory" class="db mb2">Kategori</label>
                <select name="category" id="editCategory" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
                    <option value="" disabled>Pilih Kategori</option>
                    <?php
                    $sql = "SELECT * FROM tblcategory WHERE Status=1";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $categories = $query->fetchAll(PDO::FETCH_OBJ);
                    foreach ($categories as $category) { ?>
                        <option value="<?php echo htmlentities($category->id); ?>"><?php echo htmlentities($category->CategoryName); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mv3">
                <label for="editAuthor" class="db mb2">Author</label>
                <select name="author" id="editAuthor" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
                    <option value="" disabled>Pilih Author</option>
                    <?php
                    $sql = "SELECT * FROM tblauthors";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $authors = $query->fetchAll(PDO::FETCH_OBJ);
                    foreach ($authors as $author) { ?>
                        <option value="<?php echo htmlentities($author->id); ?>"><?php echo htmlentities($author->AuthorName); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mv3">
                <label for="editISBN" class="db mb2">Nomor ISBN</label>
                <input type="text" name="isbn" id="editISBN" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
            </div>
            <div class="mv3">
                <label for="editPrice" class="db mb2">Harga</label>
                <input type="text" name="price" id="editPrice" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
            </div>
            <div class="mt4">
                <button type="submit" name="update" class="f6 link dim br2 ph3 pv2 mb2 dib dark-green bg-light-green">Save Changes</button>
            </div>
        </form>
    </div>
</div>
</div>