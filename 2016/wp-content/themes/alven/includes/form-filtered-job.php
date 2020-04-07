<form role='search' method='get' action='<?php echo $form['action']; ?>' class='jobs-form' aria-label="<?php esc_attr_e( 'Careers filters', 'alven' ); ?>">
                                <div class='jobs-search'>
                                    <input type='search' name='search' value='<?php the_search_query(); ?>' id='search'>
                                    <label for='search'>Free search</label>
                                    <button type='submit' class='btn-search btn-no-text'></button>
                                </div>
                            
                                <!-- Locations with number of jobs -->
                                <div class='select'>
                                    <select name='location'>
                                        <option value=''>All Locations</option>
                                        <?php
                                            foreach ($form['locations'] as $key => $location) {
                                                $los = $location->slug === $params['location'] ? 'selected' : '';
                                                $lo  = '<option value="'.$location->slug.'" '.$los.'>';
                                                // $lo .= $location->name.'&nbsp;('.$location->count.')';
                                                $lo .= $location->name;
                                                $lo .= '</option>';
                                                echo $lo;
                                            }
                                        ?>
                                    </select>
                                </div><div class='select'>
                                    <select name='company'>
                                        <option value=''>All Companies</option>
                                        <?php
                                            foreach ($form['startups'] as $key => $startup) {
                                                $sos = $startup['id'] == $params['company'] ? 'selected' : '';
                                                $so  = '<option value="'.$startup['id'].'" '.$sos.'>';
                                                //$so .= $startup['name'].'&nbsp;('.$startup['count'].')';
                                                $so .= $startup['name'];
                                                $so .= '</option>';
                                                echo $so;
                                            }
                                        ?>
                                    </select>
                                </div><div class='select'>
                                    <select name='function'>
                                        <option value=''>All Functions</option>
                                        <?php
                                            foreach ($form['functions'] as $key => $function) {
                                                $fos = $function->slug === $params['function'] ? 'selected' : '';
                                                $fo  = '<option value="'.$function->slug.'" '.$fos.'>';
                                                // $fo .= $function->name.'&nbsp;('.$function->count.')';
                                                $fo .= $function->name;
                                                $fo .= '</option>';
                                                echo $fo;
                                            }
                                        ?>
                                    </select>
                                </div><div class='select'>
                                    <select name='sector'>
                                        <option value=''>All Sectors</option>
                                        <?php
                                            foreach ($form['sectors'] as $key => $sector) {
                                                $seos = $sector->slug === $params['sector'] ? 'selected' : '';
                                                $seo  = '<option value="'.$sector->slug.'" '.$seos.'>';
                                                //$seo .= $sector->name.'&nbsp;('.$sector->count.')';
                                                $seo .= $sector->name;
                                                $seo .= '</option>';
                                                echo $seo;
                                            }
                                        ?>
                                    </select>
                                </div>
                                
                                <button type="submit" id="searchsubmit" class="btn">Search</button>
                            </form>