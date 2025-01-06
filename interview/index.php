<?php
if (!isset($_GET["token"])) {
    ?>
        <script>
            alert("Invalid request!");
        </script>
    <?php
} else {
    // require_once "src/EmailValidator.php";
    // require_once "src/Database.php";

    $token = $_GET["token"];
    // $email = EmailValidator::validateToken($_GET["token"]);
    $email = "aadhil2001ahamed@gmail.com";

    if ($email == null) {
        ?>
            <script>
                alert("Invalid request!");
            </script>
        <?php
    } else {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Register Here</title>

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="stylesheet" href="checkbox.css">
            <link rel="stylesheet" href="style.css">
        </head>

        <body>
            <!-- Header - start -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 header">
                        <span>Interview Registration Form</span>
                    </div>
                </div>
            </div>
            <!-- Header - end -->

            <!-- Body - start -->
            <div class="container mt-3 mt-md-4 mt-lg-5 mb-5">
                <div class="row">
                    <!-- Final Date Announcement - start -->
                    <div class="col-12 col-md-10 offset-md-1 text-center text-md-end">
                        <span class="d-block d-lg-none" style="font-weight: 500; color: rgb(220, 11, 0);">Final Date & Time of Submission<br />2025-01-03 23:59:59</span>
                        <span class="d-none d-lg-block" style="font-weight: 500; color: rgb(220, 11, 0);">Final Date & Time of Submission: 2025-01-03 23:59:59</span>
                    </div>
                    <!-- Final Date Announcement - end -->

                    <!-- Description - start -->
                    <div class="col-12 col-md-10 offset-md-1 mt-2 mt-md-3 mt-lg-4">
                        <h5 style="font-weight: 500;">Welcome to the Interview Registration!</h5>
                        <p style="font-weight: 100;">
                            Congratulations on being shortlisted for the next stage! Please use this form to select a convenient date and time for your interview. This will help us ensure a smooth scheduling process.
                        </p>
                    </div>
                    <!-- Description - end -->

                    <!-- Form - start -->
                    <div class="col-12 col-md-10 offset-md-1 mt-3 mt-lg-4">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4">
                                <label class="fs-6" style="font-weight: 500;" for="email">Your Email *</label>
                                <input type="text" class="form-control" id="email" value="<?php echo $email; ?>" disabled>
                            </div>
                        </div>
                        <div class="row mt-3 mt-md-4">
                            <div class="col-12">
                                <span class="fs-6" style="font-weight: 500;">Interview Schedule Selection *</span>
                                <p style="font-weight: 100;">Select a date and time that works best for you. Interview slots are available on a first-come, first-served basis, so we recommend registering as soon as possible.</p>
                                <!-- Interview Slots - start -->
                                <?php
                                $dates = ['2025-01-04', '2025-01-05', '2025-01-06'];
                                $times = ['10 AM', '11 AM', '04 PM', '05 PM', '08 PM', '09 PM', '10 PM'];
                                ?>
                                <div class="row">
                                    <div class="col-12">
                                        <?php
                                        foreach ($dates as $date) {
                                        ?>
                                            <div class="row mt-3">
                                                <div class="col-12 col-lg-3 d-flex">
                                                    <div class="slot slot-date" data-date="<?php echo $date; ?>"><?php echo $date; ?></div>
                                                </div>
                                                <div class="col-12 col-lg-9 mt-2 mt-lg-0 d-flex gap-2 gap-lg-3">
                                                    <?php
                                                    foreach ($times as $time) {
                                                        ?>
                                                            <div class="slot slot-time" data-time="<?php echo $time; ?>"><?php echo $time; ?></div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <!-- <div class="row">
                                            <div class="col-12 col-lg-3 d-flex">
                                                <div class="slot slot-date">2025-01-04</div>
                                            </div>
                                            <div class="col-12 col-lg-9 mt-2 mt-lg-0 d-flex gap-2 gap-lg-3">
                                                <div class="slot slot-time">10 AM</div>
                                                <div class="slot slot-time selected">11 AM</div>
                                                <div class="slot slot-time">04 PM</div>
                                                <div class="slot slot-time">05 PM</div>
                                                <div class="slot slot-time selection">08 PM</div>
                                                <div class="slot slot-time">09 PM</div>
                                                <div class="slot slot-time">10 PM</div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-lg-3 d-flex">
                                                <div class="slot slot-date">2025-01-05</div>
                                            </div>
                                            <div class="col-12 col-lg-9 mt-2 mt-lg-0 d-flex gap-2 gap-lg-3">
                                                <div class="slot slot-time">10 AM</div>
                                                <div class="slot slot-time selected">11 AM</div>
                                                <div class="slot slot-time">04 PM</div>
                                                <div class="slot slot-time">05 PM</div>
                                                <div class="slot slot-time selection">08 PM</div>
                                                <div class="slot slot-time">09 PM</div>
                                                <div class="slot slot-time">10 PM</div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-lg-3 d-flex">
                                                <div class="slot slot-date">2025-01-06</div>
                                            </div>
                                            <div class="col-12 col-lg-9 mt-2 mt-lg-0 d-flex gap-2 gap-lg-3">
                                                <div class="slot slot-time">10 AM</div>
                                                <div class="slot slot-time selected">11 AM</div>
                                                <div class="slot slot-time">04 PM</div>
                                                <div class="slot slot-time">05 PM</div>
                                                <div class="slot slot-time selection">08 PM</div>
                                                <div class="slot slot-time">09 PM</div>
                                                <div class="slot slot-time">10 PM</div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- Interview Slots - end -->
                            </div>
                        </div>
                    </div>
                    <!-- Form - end -->

                    <!-- Special Notes - start -->
                    <div class="col-12 col-md-10 offset-md-1 mt-3 mt-md-4 mt-lg-5">
                        <h5 style="font-weight: 500;">Important Information</h5>
                        <ol style="font-weight: 100;">
                            <li>The interview will be conducted via <span style="font-weight: 500; text-decoration: underline;">Google Meet.</span> Ensure you have a stable internet connection for uninterrupted session.</li>
                            <li>There is no need to dress formally. Arrange your seating comfortable for the interview.</li>
                            <li>This is an informal meeting to get to know each other, not a conventional company interview. No additional preparation is required.</li>
                            <li>Please note that the <span style="font-weight: 500; text-decoration: underline;">selected time slot cannot be changed</span> under any circumstances.</li>
                            <li>If you have any questions or concerns, feel free to contact us via email at <span style="font-weight: 500; text-decoration: underline;" class="text-primary">info@eclipselk.com</span>.</li>
                            <li>After the interview, we will evaluate all candidates and inform you of the outcome, whether you pass or fail.</li>
                        </ol>
                    </div>
                    <!-- Special Notes - end -->

                    <!-- Acknowledgment - start -->
                    <div class="col-12 col-md-10 offset-md-1 mt-3 mt-lg-4">
                        <h5 style="font-weight: 500;">Acknowledgment</h5>
                        <span style="font-weight: 100;">By submitting this form, you confirm the following:</span>
                        <div class="d-flex align-items-center mt-2">
                            <input type="checkbox" id="aggr-1">&nbsp;&nbsp;<label for="aggr-1" style="font-size: 0.9rem; font-weight: 100;">I have read and understood all the information provided above and agree to the terms.</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" id="aggr-2">&nbsp;&nbsp;<label for="aggr-2" style="font-size: 0.9rem; font-weight: 100;">I agree to attend the interview at the selected date and time.</label>
                        </div>
                    </div>
                    <!-- Acknowledgment - end -->

                    <!-- Submission - start -->
                    <div class="col-12 col-md-10 offset-md-1 mt-3 mt-lg-4">
                        <span style="font-weight: 100;">Once you submit this form with your preferred interview date and time slot, we will review your selection. A confirmation email with the meeting link will be sent to you before the interview date. Please check your email regularly for updates.</span>
                        <div class="row">
                            <div class="col-12 text-center text-md-end mt-2">
                                <button id="submitButton">Submit <span id="loader" class="d-none"></span></button>
                            </div>
                        </div>
                    </div>
                    <!-- Submission - end -->
                </div>
            </div>
            <!-- Body - end -->

            <!-- Footer - start -->
            <div class="container-fluid mb-0">
                <div class="row">
                    <div class="col-12 footer">
                        2024 @ All rights reserved
                    </div>
                </div>
            </div>
            <!-- Footer - end -->

            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <i class="bi bi-exclamation-square-fill text-warning fs-5"></i>
                        &nbsp;
                        <strong class="me-auto">Warning</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        This time slot is already reserved!
                    </div>
                </div>
            </div>

            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <i class="bi bi-exclamation-square-fill text-warning fs-5"></i>
                        &nbsp;
                        <strong class="me-auto">Warning</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        This time slot is already reserved!
                    </div>
                </div>
            </div>

            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast2" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <i class="bi bi-calendar-check-fill fs-5" style="color: rgb(20, 197, 88);"></i>
                        &nbsp;
                        <strong class="me-auto">Success</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        Your have successfully registered to the interview!
                    </div>
                </div>
            </div>

            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast3" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <i class="bi bi-x-square-fill text-danger fs-5"></i>
                        &nbsp;
                        <strong class="me-auto">Error</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body" id="toastErrMsg">
                        <!-- Render error message at runtime -->
                    </div>
                </div>
            </div>

            <script type="module" src="firebase_config.js"></script>
            <script type="module" src="firebase.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <script src="script.js"></script>
            <script type="module" src="request.js"></script>

            <script type="module">
                import { validateUser, loadTimeSlots, submitRegistration } from './request.js';
                
                window.onload = async function() {
                    if (await validateUser()) {
                        await loadTimeSlots();
                    }
                }

                document.getElementById("submitButton").addEventListener("click", async function() {
                    await submitRegistration();
                });
            </script>
        </body>

        </html>
<?php
    }
}
?>