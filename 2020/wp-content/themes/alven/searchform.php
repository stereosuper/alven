    <form role='search' method='get' action='<?php echo home_url('/'); ?>' class='form-search'>
        <div class='field-search js-field'>
            <input type='search' name='s' value='<?php the_search_query(); ?>' id='search' class="form-elt">
            <label class="label" for='search' <?php if( get_search_query() ) echo 'class="off"'; ?>>search</label>
        </div>
        <button type='submit' class='btn-search'>
            <svg class="icon"><use xlink:href="#icon-glass-bold"></use></svg>
        </button>
    </form>