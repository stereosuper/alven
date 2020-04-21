<div class='container contact'>
    <div>
        <h3 class='title-maj'><?php the_field('pitchTitle', CONTACT_ID); ?></h3>
        <?php the_field('pitchText', CONTACT_ID); ?>
        <?php if($status === 'success'){ ?>
            <p class='form-success'>Your pitch has been sent!<br> Thank you, we will be back to you shortly.</p>
        <?php }else{ ?>
            <button class='btn btn-left open-form'>Send your pitch</button>
            <?php if($errorSend){ ?>
                <p class='form-error'><?php echo $errorSend; ?></p>
            <?php } ?>
            <div class='form-to-open <?php if($status === "error") echo "form-open-error"; ?>'>
                <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
                <script>
                hbspt.forms.create({
                    portalId: "6748671",
                    formId: "7cd7a16c-fedd-47d3-981b-805f519cfe6c"
                });
                </script>
            </div>
        <?php } ?>
    </div>

    <div>
        <h3 class='title-maj'><?php the_field('generalTitle', CONTACT_ID); ?></h3>
        <?php the_field('generalText', CONTACT_ID); ?>
        <?php if($status2 === 'success'){ ?>
            <p class='form-success'>Your message has been sent!<br> Thank you, we will be back to you shortly.</p>
        <?php }else{ ?>
            <button class='btn open-form'>Contact us</button>
            <form action='<?php the_permalink(); ?>#contact' method='post' class='form-to-open <?php if($status2 === "error") echo "form-open-error"; ?>'>
                <div class='field-wrapper'>
                    <div class='field'>
                        <input type='text' name='firstname2' id='firstname2' required class='form-elt <?php if($errorFirstname2) echo "invalid"; ?>' value='<?php echo $firstname2; ?>'>
                        <label for='firstname2'>First name</label>
                    </div>
                    <div class='field'>
                        <input type='text' name='lastname2' id='lastname2' required class='form-elt <?php if($errorLastname2) echo "invalid"; ?>' value='<?php echo $lastname2; ?>'>
                        <label for='lastname2'>Last name</label>
                    </div>
                </div>
                <div class='field'>
                    <input type='email' name='email2' id='email2' required class='form-elt <?php if($errorEmail2) echo "invalid"; ?>' value='<?php echo $email2; ?>'>
                    <label for='email2'>Email</label>
                </div>
                <div class='hidden'>
                    <input type='url' name='url2' id='url2' value='<?php echo $spamUrl; ?>'>
                    <label for='url2'>Leave this field empty please</label>
                </div>
                <div class='field <?php if($errorMsg2) echo "invalid"; ?>'>
                    <textarea id='msg' name='msg' required class='form-elt <?php if($errorMsg2) echo "invalid"; ?>'><?php echo $msg2; ?></textarea>
                    <label for='msg'>Message</label>
                </div>
                <button type='submit' name='submitcontact' class='btn'>Confirm</button>
            </form>
        <?php } ?>
    </div>
</div>
