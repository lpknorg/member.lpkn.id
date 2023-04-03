                            <script type="text/javascript"
                              src="https://app.sandbox.midtrans.com/snap/snap.js"
                              data-client-key="SB-Mid-client-VMzlpKDvu6IkFgBY"></script>

                            <button class="btn btn-success" id="pay-button">Pembayaran Online</button>
                            <script type="text/javascript">
                              var payButton = document.getElementById('pay-button');
                              // For example trigger on button clicked, or any time you need
                              payButton.addEventListener('click', function () {
                                window.snap.pay('<?=$snapToken?>'); // Replace it with your transaction token
                              });
                            </script>
