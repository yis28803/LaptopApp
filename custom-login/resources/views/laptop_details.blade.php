@extends('dashboard')

@section('title', 'Laptop details')

@section('content')
    <div class="p-4 rounded-md shadow-md">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-4">
           
            
                <div id="indicators-carousel" class="relative w-full bg-gray-400 border  rounded-md" data-carousel="static">
                    <!-- Carousel wrapper -->
                    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                        <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                            <img src={{ $laptop->avatar_url }} class="absolute block rounded-md -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                        </div>
                        @foreach ($laptop->images as $image)
                        <div class="hidden duration-700 ease-in-out" data-carousel-item="">
                            <img src={{ $image->url }} class="absolute block rounded-md -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                        </div>
                        @endforeach
                    
                    
                    </div>
                    <!-- Slider indicators -->
                    <div class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse bottom-5 left-1/2">
                        @for ($i = 0; $i < $laptop->images->count()+1; $i++)
                            <button type="button" class="w-3 h-3 rounded-full " aria-label="Slide {{ $i + 1 }}" data-carousel-slide-to="{{ $i }}"></button>
                        @endfor
                    </div>
                    
                    <!-- Slider controls -->
                    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>
            <form method="POST" action="{{ route('cart.add',$laptop->id) }}" class="rounded-md py-2 px-5  bg-white flex flex-col items-start shadow-md border border-gray-300">
                <h2 class="font-bold text-2xl mb-4">
                    {{ $laptop->name }}
                </h2>
                <input type="number" name="laptop_id" class="hidden" value={{ $laptop->id }}>
                <h2 class="font-bold text-3xl mb-4 text-red-600">
                    {{ $laptop->price }}
                </h2>
                    @csrf
                    <div>
                        <label for="quantity" class="text-gray-500">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" class="rounded-md border-gray-300 text-gray-500 ">
                    </div>
                    <button type="submit" class="w-64  px-2 py-1 bg-cyan-400 hover:bg-cyan-600 border border-gray-200 rounded-md text-white mt-4 flex flex-col items-center">
                        <span>
                            BUY NOW
                        </span>
                        <span>
                            ship to home or take at shop
                        </span> 
                    </button>
                    <div class="flex flex-col mt-3 py-2 text-black" >  
                        <span style="font-size:15px">✔ 12-month genuine warranty.</span>
                        <span style="font-size:15px">✔ Free renew in 7 days.</span>
                        <span style="font-size:15px">✔ License Windows integration.&nbsp;</span>
                        <span style="font-size:15px">✔ Free shipping.</span>
                    </div>
                  
            </form>
          
        </div>
        <hr class="border-gray-400 mt-6 border-1 rounded"/>
       
        <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-3 gap-4">
            <div class="sm:col-span-2 bg-white">
                <h2 class="font-bold text-2xl mt-3 mb-2 text-cyan-500 bg-white">
                    Laptop information
                  </h2>
                  <div class="relative overflow-x-auto shadow-md sm:rounded-lg border border-gray-400">
                      
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Specifications
                                </th>
                                <th scope="col" class="px-6 py-3">
                                  
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-t-2">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                     CPU
                                </th>
                                <td class="px-6 py-4">
                                   {{ $laptop->processor }}
                                </td>
                                
                            </tr>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-t-2">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                     RAM
                                </th>
                                <td class="px-6 py-4">
                                   {{ $laptop->ram }}
                                </td>
                                
                            </tr>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-t-2">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                     ROM
                                </th>
                                <td class="px-6 py-4">
                                   {{ $laptop->rom }}
                                </td>
                                
                            </tr>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-t-2">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                     Graphic card
                                </th>
                                <td class="px-6 py-4">
                                   {{ $laptop->graphics_card }}
                                </td>
                                
                            </tr>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-t-2">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                     Screen
                                </th>
                                <td class="px-6 py-4">
                                   {{ $laptop->screen }}
                                </td>
                                
                            </tr>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-t-2">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                     Keyboard
                                </th>
                                <td class="px-6 py-4">
                                   {{ $laptop->keyboard }}
                                </td>
                                
                            </tr>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-t-2">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                     Wireless
                                </th>
                                <td class="px-6 py-4">
                                   {{ $laptop->wireless }}
                                </td>
                                
                            </tr>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-t-2">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                     LAN
                                </th>
                                <td class="px-6 py-4">
                                   {{ $laptop->lan }}
                                </td>
                                
                            </tr>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-t-2">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                     Bluetooth
                                </th>
                                <td class="px-6 py-4">
                                   {{ $laptop->bluetooth }}
                                </td>
                                
                            </tr>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-t-2">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                     Webcam
                                </th>
                                <td class="px-6 py-4">
                                   {{ $laptop->webcam }}
                                </td>
                                
                            </tr>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-t-2">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                     Battery
                                </th>
                                <td class="px-6 py-4">
                                   {{ $laptop->battery }}
                                </td>
                                
                            </tr>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-t-2">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                     OS
                                </th>
                                <td class="px-6 py-4">
                                   {{ $laptop->system }}
                                </td>
                                
                            </tr>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-t-2">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                     Weight
                                </th>
                                <td class="px-6 py-4">
                                   {{ $laptop->weight }}
                                </td>
                                
                            </tr>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-t-2">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                     Color
                                </th>
                                <td class="px-6 py-4">
                                   {{ $laptop->color }}
                                </td>
                                
                            </tr>
                           
                          
                        </tbody>
                    </table>
                </div>

                            <div class="font-bold text-lg my-8">
                                Đánh giá chi tiết laptop {{ $laptop->name }}
                            </div>
            
                        <p>ASUS Zenbook Duo OLED&nbsp;UX8406MA PZ307W&nbsp;là lựa chọn hàng đầu cho những ai đang tìm kiếm một chiếc máy tính xách tay cao cấp và tiện lợi...</p>
                    </h2><p></p><p>ASUS Zenbook Duo OLED&nbsp;UX8406MA PZ307W&nbsp;là lựa chọn hàng đầu cho những ai đang tìm kiếm một chiếc máy tính xách tay cao cấp và tiện lợi. Với độ mỏng chỉ 19.9mm và trọng lượng 1.65kg, máy phù hợp cho những người di chuyển nhiều hoặc làm việc đòi hỏi tính&nbsp;linh hoạt cao. Đặc biệt,&nbsp;<a href="https://gearvn.com/collections/laptop-asus-zenbook-series">ASUS Zenbook</a> Duo OLED&nbsp;UX8406MA PZ307W được trang bị 2 màn hình, tiện lợi cho bạn khi làm việc và giải trí cá nhân. Bên cạnh đó, máy được trang bị bộ vi xử lý vô cùng mạnh mẽ đảm bảo hiệu suất làm việc vượt trội và trải nghiệm người dùng mượt mà.</p><p></p>
                                        <div class="desc-content hidden" id="articleContent">
                                            <p style="text-align: center"><img src="//product.hstatic.net/200000722513/product/asus-zenbook-duo-oled-ux8406ma-pz307w_6f9ca3c214cf44efb3711c515400e508_80a87396502c47ec88d6fe4217d12209_grande.png"></p>
                                    <h2><strong>Cấu hình&nbsp;mạnh mẽ</strong></h2><p></p><p>ASUS Zenbook Duo OLED UX8406MA PZ307W được trang bị bộ vi xử lý Intel Ultra 7 Processor 155H với 16 nhân, 22 luồng và tốc độ tối đa lên đến 4.8GHz mang đến hiệu suất xử lý vượt trội, đảm bảo khả năng thao tác mượt mà cho các nhu cầu cơ bản như lướt web, xem phim và sử dụng ứng dụng văn phòng. Với 32GB LPDDR5X <a href="https://gearvn.com/collections/ram-laptop">RAM</a>, máy luôn hoạt động mượt mà, có khả năng chạy nhiều phần mềm cùng một lúc mà không gặp trục trặc.</p><p style="text-align: center;"><img src="//file.hstatic.net/200000722513/file/gioi-thieu-1_8ae144de26974a96b3d60c2be447df7e_grande.png"></p><h2><strong>Sở hữu đầy đủ các cổng kết nối</strong></h2><p>ASUS Zenbook Duo OLED UX8406MA PZ307W được trang bị đầy đủ các cổng kết nối tân tiến nhất: 1 cổng&nbsp;USB 3.2 Gen 1 Type-A, 2 cổng&nbsp;Thunderbolt USB-C có hỗ trợ sạc nhanh, 1 cổng&nbsp;HDMI 2.1 TMDS, 1 cổng&nbsp;giắc cắm <a href="https://gearvn.com/collections/tai-nghe-may-tinh">tai nghe</a> 3.5mm tiêu chuẩn.&nbsp;Ngoài ra,&nbsp;ASUS Zenbook Duo OLED UX8406MA PZ307W được trang bị&nbsp;Wi-Fi 6E(802.11ax) (Hai băng tần) 2*2, Bluetooth 5.3, tốc độ kết nối internet và kết nối không dây vô cùng ấn tượng.&nbsp;</p><p style="text-align: center"><img src="//file.hstatic.net/200000722513/file/cong-ket-noi_39bc11b878504be59da459b81b20c325_grande.png"></p><h2><strong>Sự đa nhiệm của bàn phím và&nbsp;touchpad </strong></h2><p></p><p>Máy được trang bị <a href="https://gearvn.com/collections/ban-phim-co">bàn phím</a> ASUS ErgoSense có thể tách rời vô cùng tiện lợi, với hành trình phím dài 1,44mm mang lại cảm giác gõ thoải mái và êm ái đến từng phím nhấn. Công nghệ ErgoSense sử dụng cơ chế phím dạng cắt kéo tối ưu, giúp giảm thiểu tiếng ồn và tiếng vang trong không gian làm việc, tạo ra một môi trường làm việc tĩnh lặng và tinh tế. Đặc biệt, touchpad lớn với cảm ứng đa điểm và chống bám vân tay, mang lại trải nghiệm sử dụng mượt mà và tiện ích hơn bao giờ hết.</p><p style="text-align: center"><img src="//file.hstatic.net/200000722513/file/ban-phim-touchpad_a2d81ebccceb4d69945c92d6ab9f44ec_grande.png"></p><p></p><h2><strong>Bộ đôi màn hình OLED 3K&nbsp;sắc nét đến từng chi tiết</strong></h2><p></p><p></p><p>Phiên bản mới nhất của ASUS Zenbook Duo OLED năm nay mang đến sự cải tiến đáng kể với 2 <a href="https://gearvn.com/pages/man-hinh">màn hình</a> 14 inch fullsize (tỷ lệ 16:10), độ phân giải 3K và tần số làm mới lên đến 120Hz. Điều này cho phép bạn tận hưởng trải nghiệm hình ảnh sắc nét và mượt mà.</p><ul><li><strong>Chế độ 2 màn hình (kết hợp với bàn phím Bluetooth):</strong> cho phép bạn tận dụng diện tích màn hình một cách hiệu quả, giúp tăng năng suất làm việc và tập trung hơn. Bạn có thể sử dụng một màn hình để làm việc và một màn hình để thực hiện các nhu cầu khác, giảm thiểu thời gian di chuyển giữa các tác vụ.</li></ul><p style="text-align: center"><img src="//file.hstatic.net/200000722513/file/ban-phim-bluetooth_73dca3b1535746838b435a34a5f8d9b2_grande.png"></p><p>&nbsp;</p><p></p><ul><li><p><strong>Chế độ 2 màn hình (kết hợp với bàn phím ảo):</strong> Nếu bạn không muốn mang theo <a href="https://gearvn.com/collections/ban-phim-bluetooth">bàn phím Bluetooth</a>, máy cho phép bạn biến màn hình dưới thành một bàn phím ảo fullsize. Để khởi động bàn phím ảo bạn chỉ cần nhấn bằng&nbsp;6 ngón tay,&nbsp;điều này tạo ra nhiều sự linh hoạt hơn cho không gian làm việc của bạn và giúp bạn tối ưu hóa trải nghiệm sử dụng.</p></li></ul><p style="text-align: center"><img src="//file.hstatic.net/200000722513/file/ban-phim-ao_d02fe758679b4448b02e9fecae669aff_grande.png"></p><ul><li><p><strong>Chế độ chia sẻ:</strong> Với tính năng này, việc chia sẻ nội dung trong các cuộc họp và thuyết trình kinh doanh trở nên dễ dàng hơn bao giờ hết. Cụ thể, chỉ cần đặt Zenbook DUO nằm phẳng, mọi người có thể dễ dàng xem màn hình mà không cần phải tụ tập xung quanh. Điều này không chỉ tạo ra một không gian làm việc linh hoạt, mà còn thúc đẩy sự tương tác và thảo luận chất lượng trong cuộc họp, giúp nâng cao hiệu suất làm việc và hiệu quả kinh doanh.</p></li></ul><p style="text-align: center"><img src="//file.hstatic.net/200000722513/file/che-do-chia-se_b8f2fc4443c5496fab7990cb7db97b94_grande.png"></p><ul><li><p><strong>Chế độ laptop:</strong> Bằng cách sử dụng bàn phím rời ASUS ErgoSense Bluetooth và đặt nó xuống màn hình dưới, bạn có thể trải nghiệm một phong cách <a href="https://gearvn.com/collections/laptop">laptop </a>truyền thống đích thực. Với màn hình 14 inch sắc nét và độ sáng lên đến 500 nits, bạn sẽ thấy các&nbsp;chi tiết hiển thị rõ ràng và vô cùng sắc nét. Điều này không chỉ mang lại sự thoải mái khi làm việc mà còn tạo ra trải nghiệm giải trí tuyệt vời, đáp ứng mọi nhu cầu của bạn mỗi ngày.</p></li></ul><p style="text-align: center;"><img src="//file.hstatic.net/200000722513/file/che-do-laptop_67e90293b29c441c82f9f07f1051f442_grande.png"></p><ul><li><p><strong>Chế độ desktop:</strong> Đây là sự lựa chọn tối ưu cho các lập trình viên, nhà nghiên cứu và nhà văn, cũng như những người làm công việc yêu cầu sự tập trung và hiệu quả cao. Bằng cách hiển thị các ứng dụng năng suất trên một màn hình và các tài liệu tham khảo, văn bản nghiên cứu trên màn hình còn lại, chế độ này giúp tối ưu hóa không gian làm việc và nâng cao khả năng đa nhiệm của bạn. Điều này không chỉ giúp bạn sắp xếp công việc khoa học mà còn thúc đẩy hiệu suất làm việc đáng kể.</p></li></ul><p style="text-align: center"><img src="//file.hstatic.net/200000722513/file/che-do-desktop_daf0905b4f5b4a8cafe6745da87c828a_grande.png"></p><h2><strong>Thời lượng pin vượt trội</strong></h2><p></p><p></p><p>Máy được trang bị pin dung lượng cao lên đến 75 Wh, mang lại khả năng làm việc liên tục và bền bỉ trong 8 giờ. Hơn nữa, tính năng sạc nhanh chỉ trong 49 phút và đạt được mức sạc 60% giúp bạn tiết kiệm thời gian và tăng cường năng suất. Đặc biệt, <a href="http://gearvn.com/blogs/thu-thuat-giai-dap/khi-sac-pin-laptop-co-can-tat-may-khong">tuổi thọ pin</a> kéo dài và thiết kế thân thiện với môi trường, hỗ trợ số chu kỳ sạc cao hơn đến 20% so với các thế hệ trước.</p><p style="text-align: center;"><strong><img width="602" height="601" src="https://lh7-us.googleusercontent.com/6l2kiNx6-eCWeIbmUw7ixrkJrDi08kvBKhuPiU3LVaAG7R4eLSahw5a755TQ3VjSa06yUBhApwXk2RJ67URyfJ-AhYGyQFnVW4LcVXC90pRoIfLBlX3jwJ9hhumWfesRzqPjXvgV_486EvZhtvLffA"></strong></p><p></p><p></p><h2><strong>Tổng kết</strong></h2><p>Mẫu laptop ASUS Zenbook Duo OLED UX8406MA PZ307W là sự lựa chọn lý tưởng cho những người sáng tạo nội dung và những ai đang tìm kiếm hiệu năng mạnh mẽ. Với thiết kế đẹp mắt và sang trọng, máy tính này không chỉ mang lại hiệu suất ấn tượng mà còn sở hữu tấm nền OLED sống động và nhiều tính năng hữu ích khác. Hiện sản phẩm đang có mặt tại Gearvn với mức giá cực kỳ hấp dẫn và nhiều chương trình khuyến mãi đặc biệt. Đừng ngần ngại liên hệ qua hotline 18006975 để được tư vấn miễn phí và đặt hàng ngay hôm nay!</p><p></p>
                                        </div>
                                        <div class="desc-btn mx-auto">
                                            <button class="expandable-btn button bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded" onclick="toggleDescription()">
                                                <span class="expandable-toggle--text more" id="more">Đọc tiếp bài viết</span>
                                                <span class="expandable-toggle--text less hidden" id="less">Thu gọn bài viết</span>
                                                <span class="" id="img-more">
                                                    <svg class="h-4 w-4 fill-current" viewBox="0 0 8 8" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M6.5 2.5L4 5.5L1.5 2.5" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </span>
                                                <span class="hidden" id="img-less">
                                                    <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12 2L1 14h22L12 2zm0 4.586L17.414 14H6.586L12 6.586z"/>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                        
            </div>
            <div class="">
                <h2 class="font-bold text-2xl mt-3 mb-2 text-cyan-500">
                  Similar laptops
                </h2>
                <div class="border rounded-md p-5 shadow-md">
                    @foreach ($similar_laptops as $laptop)
                    <a class="flex items-center gap-4 mb-5 hover:scale-110 transition-all " href={{ route('laptop_detail.index',['id'=>$laptop->id]) }}>
                      <img class="w-28  h-20" src={{ $laptop->avatar_url }} alt="">
                      <div class="font-medium dark:text-white text-md">
                          <div>{{ $laptop->name }}</div>
                          <div class="text-sm text-gray-400  line-through">{{ $laptop->price + 500 }}</div>
                          <div class="flex">
                            <div class="text-xl text-cyan-500 ">{{ $laptop->price }}</div>
                            <div class="bg-cyan-50 border border-cyan-400 rounded-md text-sm text-center text-cyan-400 ml-1 p-1">
                                - {{ intval(50000 / $laptop->price) }}%
                            </div>
                          </div>
                          <div class="rounded-md flex text-yellow-200 text-sm gap-1">
                            @php
                                $randomRate = mt_rand(400, 500) / 100;
                            @endphp
                            {{ $randomRate }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="yellow">
                                <path d="M12 2l2.4 7.4H22l-6.1 4.6 2.3 7.2L12 17.6 5.8 21.2l2.3-7.2L2 9.4h7.6L12 2z"/>
                            </svg>
                            <div class="text-gray-400">
                                {{ "(0 comment)" }}
                            </div>
                        </div>
                        
                      </div>
                  </a>
                    @endforeach
                </div>
                <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
             <h2 class="font-bold text-2xl mb-2 text-cyan-500">
                Tech news
             </h2>
             <div class="border rounded-md p-5 shadow-md">
                <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img class="h-auto w-full md:w-40 md:h-32" src="https://genk.mediacdn.vn/thumb_w/640/139269124445442048/2024/5/13/fal00850-17155830232081863825968.jpg" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-md  tracking-tight text-gray-900 ">Ra mắt phần mềm "Chống lừa đảo" Phát hiện SDT, tài khoản ngân hàng, website, QR code, ứng dụng lừa đảo</h5>
                      
                    </div>
                </a>
                <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img class="h-auto w-full md:w-40 md:h-32" src="https://genk.mediacdn.vn/139269124445442048/2024/5/13/genk-realme-gt-neo6-se-1-17155829057692006992847.jpg" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-md  tracking-tight text-gray-900 ">Điện thoại Snapdragon 7+ Gen 3 giá rẻ chỉ hơn 6 triệu đồng</h5>
                      
                    </div>
                </a>
                <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img class="h-auto w-full md:w-40 md:h-32" src="https://genk.mediacdn.vn/thumb_w/640/139269124445442048/2024/4/25/v3qqdgfjzpyzhemrqzuk9b-650-80-17140411687521101003973.jpg" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-md  tracking-tight text-gray-900 ">Người Nhật mua được CPU Core i7 với giá chỉ 80.000 đồng</h5>
                      
                    </div>
                </a>
                <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img class="h-auto w-full md:w-40 md:h-32" src="https://genk.mediacdn.vn/thumb_w/640/139269124445442048/2024/5/10/cn-11134207-7r98o-lp8vv746ixr051-17153345332541770859682.jpg" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-md  tracking-tight text-gray-900 ">Hộp sạc đa năng có gì hay mà có đến cả nghìn lượt mua, giá chưa đến 160.000 đồng</h5>
                      
                    </div>
                </a>
               
             </div>
            </div>
            
            </div>
            <div class="border mx-auto p-5 my-1 shadow-md">
                <h2 class="text-xl mb-2">
                    Rate and review the laptop {{ $laptop->name }}
                </h2>
               
                <div class="flex flex-col gap-1 items-center">
                    <div class="flex items-center space-x-1 gap-3">
                        
                        <label for="star1" class="flex items-center"> 1
                            
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="yellow">
                                <path d="M12 2l2.4 7.4H22l-6.1 4.6 2.3 7.2L12 17.6 5.8 21.2l2.3-7.2L2 9.4h7.6L12 2z"/>
                            </svg>
                        </label>
                        <div class="bg-slate-400 w-72 p-1 rounded-lg"></div>
                        <span class="text-sm">
                            0 review</span>
                    </div>
                    <div class="flex items-center space-x-1 gap-3">
                        
                        <label for="star2"  class="flex items-center"> 2
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="yellow">
                                <path d="M12 2l2.4 7.4H22l-6.1 4.6 2.3 7.2L12 17.6 5.8 21.2l2.3-7.2L2 9.4h7.6L12 2z"/>
                            </svg>
                        </label>
                        <div class="bg-slate-400 w-72 p-1 rounded-lg"></div>
                        <span class="text-sm">
                            0 review</span>
                    </div>
                    <div class="flex items-center space-x-1 gap-3">
                       
                        <label for="star3" class="flex items-center "> 3
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="yellow">
                                <path d="M12 2l2.4 7.4H22l-6.1 4.6 2.3 7.2L12 17.6 5.8 21.2l2.3-7.2L2 9.4h7.6L12 2z"/>
                            </svg>
                        </label>
                        <div class="bg-slate-400 w-72 p-1 rounded-lg"></div><span class="text-sm">
                            0 review</span>
                    </div>
                    <div class="flex items-center space-x-1 gap-3">
                     
                        <label for="star4"  class="flex items-center"> 4
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="yellow">
                                <path d="M12 2l2.4 7.4H22l-6.1 4.6 2.3 7.2L12 17.6 5.8 21.2l2.3-7.2L2 9.4h7.6L12 2z"/>
                            </svg>
                        </label>
                        <div class="bg-slate-400 w-72 p-1 rounded-lg"></div>
                        <span class="text-sm">
                            0 review</span>
                    </div>
                    <div class="flex items-center space-x-1 gap-3">
                        
                        <label for="star5"  class="flex items-center"> 5
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="yellow">
                                <path d="M12 2l2.4 7.4H22l-6.1 4.6 2.3 7.2L12 17.6 5.8 21.2l2.3-7.2L2 9.4h7.6L12 2z"/>
                            </svg>
                        </label>
                        <div class="bg-slate-400 w-72 p-1 rounded-lg"></div>
                        <span class="text-sm">
                            0 review</span>
                    </div>
                </div>
                <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
                <button class="px-2 py-1 bg-cyan-400 hover:bg-cyan-600 text-white rounded-md shadow-md md:w-56">
                    Send your rating
                </button>
            </div>
           
            
            
            <script>
                function toggleDescription() {
                    var content = document.getElementById("articleContent");
                    var button = document.querySelector('.desc-btn .expandable-btn');
                    var moreButton = document.getElementById('more')
                    var lessButton = document.getElementById('less')
                    var moreImg = document.getElementById('more-img')
                    var lessImg = document.getElementById('less-img')

                    if (content.classList.contains('hidden')) {
                        content.classList.remove('hidden');
                        lessButton.classList.remove('hidden');
                        moreButton.classList.add('hidden');
                        moreImg.classList.add("hidden");
                        lessImg.classList.remove("hidden");
                    } else {
                        content.classList.add('hidden');
                        lessButton.classList.add('hidden');
                        moreButton.classList.remove('hidden');
                        moreImg.classList.remove("hidden");
                        lessImg.classList.add("hidden");
                    }
                }
            </script>
        </div>
      
@endsection
