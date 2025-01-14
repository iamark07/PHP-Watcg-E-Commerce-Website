<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css link -->
    <link rel="stylesheet" href="assets/css/user_address.css">

    <!-- tailwind css link -->
    <!-- <link rel="stylesheet" href="tailwind_config/tailwind_output.css"> -->

    <!-- flowbite tailwind css cdn -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" /> -->

    <!-- rimix icon cdn link -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />

    <!-- FONT AWESOME CDN LINK-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />

    <!-- tailwind css -->
    <script src="https://cdn.tailwindcss.com"></script>
    <title>User Address</title>
</head>

<body>
    <main class="bg-gray-50 h-screen relative">
        <div class="user_add_container">
            <div class="user_add_wrapper w-full p-5 md:py-7 md:px-10 flex gap-10 flex-col md:justify-center lg:flex-row">
                <div class="add_form flex gap-3 w-full flex-col p-5 cart_shadow bg-white rounded-lg">
                    <div class="use_current_loc mb-3">
                        <span id="useCurrentLocation" class="cursor-pointer text-md">
                            <i class="ri-map-pin-line me-2 text-blue-500"></i> Use current Location
                        </span>
                    </div>
                    <form action="" class="grid gap-3 grid-cols-1 lg:grid-cols-2">
                        <div class="input_boxes flex flex-col">
                            <input type="text" placeholder="Full Name"
                                class="border border-gray-300 border-solid w-full rounded-sm p-3 cursor-pointer">
                        </div>
                        <div class="input_boxes flex flex-col">
                            <input type="text" placeholder="Enter Mobile Number"
                                class="border border-gray-300 border-solid w-fullrounded-sm p-3 cursor-pointer">
                        </div>
                        <div class="input_boxes flex flex-col">
                            <input type="text" placeholder="Pincode"
                                class="border border-gray-300 border-solid w-full rounded-sm p-3 cursor-pointer">
                        </div>
                        <div class="input_boxes flex flex-col">
                            <input type="text" placeholder="Address (Area and Street)"
                                class="border border-gray-300 border-solid w-full rounded-sm p-3 cursor-pointer">
                        </div>
                        <div class="input_boxes flex flex-col">
                            <input type="text" placeholder="City/District/Town"
                                class="border border-gray-300 border-solid w-full rounded-sm p-3 cursor-pointer">
                        </div>
                        <div class="input_boxes flex flex-col">
                            <!-- States of India -->
                            <select class="border border-gray-300 border-solid w-full rounded-sm p-3 cursor-pointer">
                                <option value="AP">Andhra Pradesh</option>
                                <option value="AR">Arunachal Pradesh</option>
                                <option value="AS">Assam</option>
                                <option value="BR">Bihar</option>
                                <option value="CT">Chhattisgarh</option>
                                <option value="GA">Gujarat</option>
                                <option value="HR">Haryana</option>
                                <option value="HP">Himachal Pradesh</option>
                                <option value="JK">Jammu and Kashmir</option>
                                <option value="GA">Goa</option>
                                <option value="JH">Jharkhand</option>
                                <option value="KA">Karnataka</option>
                                <option value="KL">Kerala</option>
                                <option value="MP">Madhya Pradesh</option>
                                <option value="MH">Maharashtra</option>
                                <option value="MN">Manipur</option>
                                <option value="ML">Meghalaya</option>
                                <option value="MZ">Mizoram</option>
                                <option value="NL">Nagaland</option>
                                <option value="OR">Odisha</option>
                                <option value="PB">Punjab</option>
                                <option value="RJ">Rajasthan</option>
                                <option value="SK">Sikkim</option>
                                <option value="TN">Tamil Nadu</option>
                                <option value="TG">Telangana</option>
                                <option value="TR">Tripura</option>
                                <option value="UT">Uttarakhand</option>
                                <option value="UP">Uttar Pradesh</option>
                                <option value="WB">West Bengal</option>
                                <option value="AN">Andaman and Nicobar Islands</option>
                                <option value="CH">Chandigarh</option>
                                <option value="DN">Dadra and Nagar Haveli</option>
                                <option value="DD">Daman and Diu</option>
                                <option value="DL">Delhi</option>
                                <option value="LD">Lakshadweep</option>
                                <option value="PY">Puducherry</option>
                            </select>
                        </div>

                        <div class="submit_btn mt-5 flex gap-3">
                            <input type="submit"
                                class="cursor-pointer animate-btn-color bg-blue-500 border border-solid border-blue-500 text-white py-3 px-8 rounded-sm">
                            <a href="cart.php"
                                class="cursor-pointer bg-white border border-solid border-blue-500 text-blue-500 py-3 px-8">Cancel
                            </a>
                        </div>
                    </form>
                </div>
                <div class="total_order_amount_container">
                    <div class="total_order_amount cart_shadow bg-white w-full lg:!w-96 p-5 rounded-lg">
                        <h2 class="text-xl font-bold">Total Cart</h2>
                        <div class="total_order_amount mt-3">
                            <p class="flex text-md justify-between">Solly Analog premium Watch For Men
                                <span class="pro_amount flex items-center gap-2 text-gray-900 dark:text-white"
                                    style="font-size: 20px;">
                                    <i class="fa-solid fa-indian-rupee-sign" style="font-size: 14px;"></i> 1,199
                                </span>
                            </p>
                            <p class="flex text-md justify-between">Solly Analog premium Watch For Men
                                <span class="pro_amount flex items-center gap-2 text-gray-900 dark:text-white"
                                    style="font-size: 20px;">
                                    <i class="fa-solid fa-indian-rupee-sign" style="font-size: 14px;"></i> 1,199
                                </span>
                            </p>
                            <p class="flex text-md justify-between">Sales Tax
                                <span class="pro_amount flex items-center gap-2 text-gray-900 dark:text-white"
                                    style="font-size: 20px;">
                                    <i class="fa-solid fa-indian-rupee-sign" style="font-size: 14px;"></i> 20
                                </span>
                            </p>
                            <p class="flex text-md justify-between">Shipping
                                <span class="pro_amount flex items-center gap-2 text-gray-900 dark:text-white"
                                    style="font-size: 20px;">
                                    <i class="fa-solid fa-indian-rupee-sign" style="font-size: 14px;"></i> Free
                                </span>
                            </p>
                            <div class="total mt-10 pt-5 border-t border-solid border-gray-300">
                                <p class="flex text-2xl justify-between">Total
                                    <span class="pro_amount flex items-center gap-2 text-green-500"
                                        style="font-size: 30px;">
                                        <i class="fa-solid fa-indian-rupee-sign" style="font-size: 24px;"></i> 2,420
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        document.getElementById("useCurrentLocation").addEventListener("click", () => {
            // Check if Geolocation is supported
            if (navigator.geolocation) {
                // Get the user's location
                navigator.geolocation.getCurrentPosition(
                    async (position) => {
                            const {
                                latitude,
                                longitude
                            } = position.coords;
                            console.log(`Latitude: ${latitude}, Longitude: ${longitude}`);

                            // Replace 'YOUR_API_KEY' with your Google Maps API key
                            const apiKey = "AIzaSyBgAyzVLVVUYJxNHn_4qYIr5LDDYjiT-5Y";
                            const geocodeURL = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=${apiKey}`;

                            try {
                                // Fetch the address from the Geocoding API
                                const response = await fetch(geocodeURL);
                                const data = await response.json();
                                console.log(data);

                                if (data.status === "OK" && data.results.length > 0) {
                                    const address = data.results[0].formatted_address;

                                    // Extract city and state
                                    const city = data.results[0].address_components.find((comp) =>
                                        comp.types.includes("locality")
                                    )?.long_name || "";
                                    const state = data.results[0].address_components.find((comp) =>
                                        comp.types.includes("administrative_area_level_1")
                                    )?.short_name || "";

                                    // Fill form fields
                                    document.querySelector("input[placeholder='City/District/Town']").value = city;
                                    document.querySelector("select").value = state;
                                    document.querySelector("input[placeholder='Address (Area and Street)']").value = address;

                                    alert("Location fetched successfully!");
                                } else {
                                    alert("Unable to fetch address. Try again.");
                                }
                            } catch (error) {
                                console.error("Error fetching address:", error);
                                alert("Error occurred while fetching the location.");
                            }
                        },
                        (error) => {
                            console.error("Geolocation error:", error);
                            alert("Failed to retrieve location. Enable location access.");
                        }
                );
            } else {
                alert("Geolocation is not supported by your browser.");
            }
        });
    </script>
</body>

</html>