<div class='container' id='contact'>
    <div class='grid wrapper-interactive-blocks'>
        <div class='col-4 align-right interactive-block'>
            <h3><?php the_field('pitchTitle', CONTACT_ID); ?></h3>
            <?php the_field('pitchText', CONTACT_ID); ?>
            <?php if($status === 'success'){ ?>
                <p class='form-success'>Your pitch has been sent!<br> Thank you, we will be back to you shortly.</p>
            <?php }else{ ?>
                <button class='btn btn-left open-form'>Send your pitch</button>
                <?php if($errorSend){ ?>
                    <p class='form-error'><?php echo $errorSend; ?></p>
                <?php } ?>
                <form action='<?php the_permalink(); ?>#contact' method='post' enctype='multipart/form-data' class='align-left form-to-open <?php if($status === "error") echo "form-open-error"; ?>'>
                    <fieldset>
                        <legend class='active'>Let's <span>Introduce yourself</span></legend>
                        <section class='form-section <?php if($errorFirstname || $errorLastname || $errorEmail) echo "invalid"; ?>'>
                            <div>
                                <input type='text' name='firstname1' id='firstname1' required class='form-elt <?php if($errorFirstname) echo "invalid"; ?>' value='<?php echo $firstname; ?>'>
                                <label for='firstname1'>Your firstname</label>
                            </div><div>
                                <input type='text' name='lastname1' id='lastname1' required class='form-elt <?php if($errorLastname) echo "invalid"; ?>' value='<?php echo $lastname; ?>'>
                                <label for='lastname1'>Your lastname</label>
                            </div><div class='large'>
                                <input type='email' name='email1' id='email1' required class='form-elt <?php if($errorEmail) echo "invalid"; ?>' value='<?php echo $email; ?>'>
                                <label for='email1'>Your email</label>
                            </div>
                        </section>
                    </fieldset>
                    <fieldset>
                        <legend>Send us <span>Your amazing pitch</span></legend>
                        <section class='form-section <?php if($errorFile || $errorUrl || $errorMsg) echo "invalid"; ?>'>
                            <div class='full has-desc'>
                                <input type='file' name='pitchfile' id='pitchfile'><label for='pitchfile'>
                                    Upload your file
                                </label><span class='form-desc'>
                                    a lightweight .pdf, .doc, .ptt, ...
                                </span>
                            </div>
                            <span class='form-title'>Or</span>
                            <div class='full has-desc'>
                                <input type='url' name='pitchurl' id='pitchurl' class='form-elt <?php if($errorUrl) echo "invalid"; ?>'><label for='pitchurl' value='<?php echo $url; ?>'>
                                    Send us your link
                                </label><span class='form-desc'>
                                    a web page which describe your product or service
                                </span>
                            </div>
                            <span class='form-title'>And</span>
                            <div class='full'>
                                <textarea name='pitchtext' id='pitchtext' required class='form-elt <?php if($errorMsg) echo "invalid"; ?>'><?php echo $msg; ?></textarea>
                                <label for='ptichtext'>Write us a few word there about what you expect from us</label>
                            </div>
                        </section>
                    </fieldset>
                    <button type='submit' name='submitpitch' class='btn-invert'>Confirm</button>
                </form>
            <?php } ?>
        </div><div class='col-4 interactive-block'>
            <h3><?php the_field('generalTitle', CONTACT_ID); ?></h3>
            <?php the_field('generalText', CONTACT_ID); ?>
            <?php if($status2 === 'success'){ ?>
                <p class='form-success'>Your message has been sent!<br> Thank you, we will be back to you shortly.</p>
            <?php }else{ ?>
                <button class='btn open-form'>General questions</button>
                <form action='<?php the_permalink(); ?>#contact' method='post' class='align-left form-to-open <?php if($status2 === "error") echo "form-open-error"; ?>'>
                    <fieldset>
                        <legend class='active'>Let's <span>Introduce yourself</span></legend>
                        <section class='form-section <?php if($errorFirstname2 || $errorLastname2 || $errorEmail2) echo "invalid"; ?>'>
                            <div>
                                <input type='text' name='firstname2' id='firstname2' required class='form-elt <?php if($errorFirstname2) echo "invalid"; ?>' value='<?php echo $firstname2; ?>'>
                                <label for='firstname2'>Your firstname</label>
                            </div><div>
                                <input type='text' name='lastname2' id='lastname2' required class='form-elt <?php if($errorLastname2) echo "invalid"; ?>' value='<?php echo $lastname2; ?>'>
                                <label for='lastname2'>Your lastname</label>
                            </div><div class='large'>
                                <input type='email' name='email2' id='email2' required class='form-elt <?php if($errorEmail2) echo "invalid"; ?>' value='<?php echo $email2; ?>'>
                                <label for='email2'>Your email</label>
                            </div>
                        </section>
                    </fieldset>
                    <fieldset>
                        <legend>We're ready to read: <span>What would you like to know?</span></legend>
                        <section class='form-section <?php if($errorMsg2) echo "invalid"; ?>'>
                            <div class='full'>
                                <textarea id='msg' name='msg' required class='form-elt <?php if($errorMsg2) echo "invalid"; ?>'><?php echo $msg2; ?></textarea>
                                <label for='msg'>Write us a few word there about what you expect from us</label>
                            </div>
                        </section>
                    </fieldset>
                    <button type='submit' name='submitcontact' class='btn-invert'>Confirm</button>
                </form>
            <?php } ?>
        </div>
    </div>
</div>
