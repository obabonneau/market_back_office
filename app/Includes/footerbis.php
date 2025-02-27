                </main>
                <!-- END OF PAGE CONTENT -->

            </div>
            <!-- END OF MAIN CONTENT -->

            <!-- FOOTER -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Back Office 2025 ® Tous droits réservés.</span>
                    </div>
                </div>
            </footer>
            <!-- END OF FOOTER -->

        </div>
        <!-- END OF CONTENT WRAPPER -->

    </div>
    <!-- END OF PAGE WRAPPER -->

    <!-- SCROLL TO TOP -->
    <a id="arrowScroll" class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
   
    <!-- MODAL DE DECONNEXION -->
    <?php include "modalLogout.php"; ?>

    <!-- SCRIPTS DE LA PAGE -->
    <?php if (isset($scripts)) :
        foreach ($scripts as $script) : ?>
            <script <?php echo $script; ?>></script>
        <?php endforeach;
    endif; ?>
</body>