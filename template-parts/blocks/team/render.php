<?php
// Proveri ako Repeater polje sadrži članove tima
if( have_rows('team_members') ): ?>
    <section class="team-section">
        <div class="container align-items  display-flex flex-column "> <!-- Dodan container div -->
            <div class="team-head">
                <div class="team-subtitle">Our Team</div>
                <h2 class="team-title">The amazing team behind<br>Agencypro</h2>
            </div>
            <div class="team-grid">
                <?php
                // Petlja kroz članove tima
                while( have_rows('team_members') ): the_row();
                    // Povuci podatke iz sub-polja
                    $name = get_sub_field('member_name');
                    $position = get_sub_field('position');
                    $description = get_sub_field('description');
                    $avatar = get_sub_field('avatar');  

                    $avatar_url = isset($avatar) ? esc_url($avatar) : 'default-avatar.jpg'; // Ako avatar nije postavljen, koristi podrazumevanu sliku

                     
                ?>
                    <div class="team-card">
                        <div class="team-avatar">
                            <img src="<?php echo $avatar_url; ?>" alt="<?php echo esc_attr($name); ?>">
                        </div>
                        <div class="team-name"><?php echo esc_html($name); ?></div>
                        <div class="team-role"><?php echo esc_html($position); ?></div>
                        <div class="team-desc"><?php echo esc_html($description); ?></div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="join-btn">
                <a href="your-link-here" class="btn btn-primary">Join Our Team &rarr;</a>
            </div>
        </div> <!-- Kraj container div-a -->
    </section>
<?php endif; ?>
