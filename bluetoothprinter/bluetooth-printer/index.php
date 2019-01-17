<?php 
?>

<!doctype html>

<html>
  <head>
    <title>Bluetooth Printer</title>
    <style is="custom-style">
      paper-progress {
        width: 100%;
      }
      paper-progress.blue {
        paper-progress-active-color: var(--paper-light-blue-500);
        paper-progress-secondary-color: var(--paper-light-blue-100);
      }
      paper-slider {
        width: 100%;
      }
      paper-slider.blue {
        paper-slider-active-color: var(--paper-light-blue-500);
        paper-slider-knob-color: var(--paper-light-blue-500);
      }
      paper-button {
        display: block;
        margin-bottom: 2px;
      }
      paper-button.colorful {
        color: #4285f4;
      }
      paper-button[raised].colorful {
        background: #4285f4;
        color: #fff;
      }
      paper-button.blue {
        color: var(--paper-light-blue-500);
        paper-button-flat-focus-color: var(--paper-light-blue-50);
      }
      body {
        background-color: var(--paper-grey-50);
      }
      #cards {
        margin-left: auto;
        margin-right: auto;
        max-width: 400px;
      }
      #logo-img{
        width: 70px;
        height: 70px;
      }
      paper-card {
        margin-bottom: 5px;
        margin-top: 5px;
        width: 100%;
      }
      paper-card#logo {
        @apply(--layout-vertical);
        @apply(--layout-center);
      }
    </style>
    <meta name="description" content="Print text and images to a Bluetooth Printer with a Web Bluetooth app.">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1, user-scalable=yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>

    <script src="<?php echo $CONFIG['site'];?>/bluetoothprinter/bluetooth-printer/bower_components/webcomponentsjs/webcomponents-lite.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">  

    <!-- Polymer components -->
    <link rel="import" href="<?php echo $CONFIG['site'];?>/bluetoothprinter/bluetooth-printer/bower_components/paper-progress/paper-progress.html">
    <link rel="import" href="<?php echo $CONFIG['site'];?>/bluetoothprinter/bluetooth-printer/bower_components/paper-slider/paper-slider.html">
    <link rel="import" href="<?php echo $CONFIG['site'];?>/bluetoothprinter/bluetooth-printer/bower_components/paper-button/paper-button.html">
    <link rel="import" href="<?php echo $CONFIG['site'];?>/bluetoothprinter/bluetooth-printer/bower_components/paper-card/paper-card.html">
    <link rel="import" href="<?php echo $CONFIG['site'];?>/bluetoothprinter/bluetooth-printer/bower_components/paper-dialog/paper-dialog.html">
    <link rel="import" href="<?php echo $CONFIG['site'];?>/bluetoothprinter/bluetooth-printer/bower_components/paper-input/paper-input.html">
    <link rel="import" href="<?php echo $CONFIG['site'];?>/bluetoothprinter/bluetooth-printer/bower_components/paper-input/paper-input-container.html">
    <link rel="import" href="<?php echo $CONFIG['site'];?>/bluetoothprinter/bluetooth-printer/bower_components/paper-input/paper-input-error.html">
    <link rel="import" href="<?php echo $CONFIG['site'];?>/bluetoothprinter/bluetooth-printer/bower_components/paper-input/paper-input-char-counter.html">
    <link rel="import" href="<?php echo $CONFIG['site'];?>/bluetoothprinter/bluetooth-printer/bower_components/paper-input/paper-textarea.html">

    <link rel="import" href="<?php echo $CONFIG['site'];?>/bluetoothprinter/bluetooth-printer/bower_components/paper-styles/color.html">
    <link rel="stylesheet" href="<?php echo $CONFIG['site'];?>/bluetoothprinter/bluetooth-printer/bower_components/paper-styles/demo.css">
    

    
  </head>
  <body unresolved>
    <div id="cards">
      <paper-card>
        <div style="float:left;"><image id="logo-img" src="<?php echo $CONFIG['site'];?>/bluetoothprinter/bluetooth-printer/favicon.png"  ></image></div>
        <div style="float: left"><h1>BlueTooth_Printer</h1></div>
        <div style="clear:both;"></div>
        <div class="card-content">
          <paper-progress id="progress" indeterminate></paper-progress>
        </div>
      </paper-card>

    <paper-card id="logo">
        <div class="card-content"id="image_page">
          <div >
              <div style="float:left; margin:20px;">
                  <image id="icon" src="<?php echo $CONFIG['site'];?>/bluetoothprinter/bluetooth-printer/logo-black.png" width="40px"></image>
              </div>
               
                    <div style="float:left;" id="title">
                        <h2 style="margin: 0">Da Valley Grill</h2>
                        <h3 style="margin: 0">Hawaiian Style Asian Food</h3>
                        <h5 style="margin: 0">2040 W.Deer Vallery Rd.<br> Phoenix, AZ 85032</h5>
                    </div>
                    <div style="clear:both;"></div>
                    <div id="content">
                     <?php                 
                        $conf_number = "";
                        if(isset($_SESSION['orderID'])) { $conf_number = "Your confirmation number is #" . $_SESSION['orderID']; }
                        ?>
                        <table width="auto">
                            <tr>
                                <thead>
                                    <th>No</th>
                                    <th>Product</th>              
                                    <th>Qty</th>
                                    <th>Price</th>
                                </thead>
                                <tbody></tbody>
                            </tr>
                                 <?php
                                  $i =0;
                                  $totalPrice = 0;
                                  foreach($_SESSION['products'] as $item) {

                                    if(!empty($item['cookWith'])) { $cookWith = " with ". $item['cookWith']; } else { $cookWith = ""; }

                                echo '<tr valign="top">
                                  <td style="font-size:10px">'.($i+1).'.</td>
                                  <td style="font-size:10px ;align:center;">'.$item['itemName'] . $cookWith . '</td>
                                  <td style="font-size:10px"> '.$item['quantity'].' </td>   
                                  <td style="font-size:10px">'.$item['itemPrice'].'</td>  
                                      </tr>
                                ';
                                $i++;
                                $totalPrice += ($item['itemPrice'] * $item['quantity']);
                                }
                                $total_tax = $totalPrice * $CONFIG['state_tax'] / 100;
                                $totalPrice += $total_tax;
                                $totalPrice = round($totalPrice,2);
                                $total_tax = round($total_tax, 2);

                                echo '<tr valign="top"><td></td><td></td><td style="font-size:10px"><b>Tax:</b></td><td style="font-size:10px">$'.$total_tax.'</td></tr>';
                          ?>
                        <tr>
                          <td></td>
                          <td></td>
                          <td style="font-size:10px">
                            <b>Tip:</b>
                          </td>
                          <td style="font-size:10px">
                            <?php
                              if($_SESSION["tipType"] == "percentage") {
                                $tipValue = $_SESSION["tipValue"];
                                echo '$'.number_format($tipAmount = ( ($totalPrice*$tipValue)/100 ), 2);
                                $totalPrice += $tipAmount;
                              } else {
                                $tipValue = $_SESSION["tipValue"];
                                echo '$'.(number_format($tipValue,2));
                                $totalPrice += $tipValue;
                              }
                            ?>
                          </td>
                  </tr>
                <?php
                echo '<tr><td></td><td></td><td style="font-size:10px"><b>Total Price:</b></td><td style="font-size:10px">$'.$totalPrice.'</td></tr>';
                ?>
                </table>
                </div>
          </div>
        </div>
      </paper-card> 

      

      
      <paper-card>
        <div class="card-content">      
            <image id="image" src="" style="display:none;"></image>
            <button id="preview"  class="btn btn-primary" style="width:49%; background-color:#4285f4;">Image-Preview</button>  
            <a id="btn-Convert-Html2Image" href="#" class="btn btn-primary" style="width:49%;background-color:#4285f4;">Image-Save</a> 
        
              
        </div>
      </paper-card>

      <paper-card>
        <div class="card-content">
          <paper-button id="print" raised class="colorful">BlueTooth-Print</paper-button>
        </div>
      </paper-card>

      <paper-dialog id="dialog">
        <h2>Error</h2>
        <p>Could not connect to bluetooth device!</p>
      </paper-dialog>
   </div>

   <script type="text/javascript">
   
      var element = $("#image_page"); 
      var getCanvas;   
      var nowTime = Date();   
     html2canvas(element, {
     onrendered: function (canvas) {                     
            getCanvas = canvas;
           var imgageData = getCanvas.toDataURL("image/png");   
          var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
          $ ( "#image" ). attr ( "src" , newData);
         }
     });
    
     $("#preview").click(function(){
      
           $('#image').show();     
      
     });


     $("#btn-Convert-Html2Image").on('click', function () {
     
          var imgageData = getCanvas.toDataURL("image/png");
    
          var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
    $("#btn-Convert-Html2Image").attr("download","order-"+nowTime+".png").attr("href", newData);
      });
     
     
    </script>

    <script>
      'use strict';
      document.addEventListener('WebComponentsReady', function() {
        let progress = document.querySelector('#progress');
        let dialog = document.querySelector('#dialog');
        let message = document.querySelector('#message');
        let printButton = document.querySelector('#print');
        let printCharacteristic;
        let index = 0;
        let data;
        progress.hidden = true;     
       
        
        function getDarkPixel(x, y) {
          // Return the pixels that will be printed black
          let red = imageData[((canvas.width * y) + x) * 4];
          let green = imageData[((canvas.width * y) + x) * 4 + 1];
          let blue = imageData[((canvas.width * y) + x) * 4 + 2];
          return (red + green + blue) > 0 ? 1 : 0;
        }

        function getImagePrintData() {
          if (imageData == null) {
            console.log('No image to print!');
            return new Uint8Array([]);
          }
          // Each 8 pixels in a row is represented by a byte
          let printData = new Uint8Array(canvas.width / 8 * canvas.height + 8);
          let offset = 0;
          // Set the header bytes for printing the image
          printData[0] = 29;  // Print raster bitmap
          printData[1] = 118; // Print raster bitmap
          printData[2] = 48; // Print raster bitmap
          printData[3] = 0;  // Normal 203.2 DPI
          printData[4] = canvas.width / 8; // Number of horizontal data bits (LSB)
          printData[5] = 0; // Number of horizontal data bits (MSB)
          printData[6] = canvas.height % 256; // Number of vertical data bits (LSB)
          printData[7] = canvas.height / 256;  // Number of vertical data bits (MSB)
          offset = 7;
          // Loop through image rows in bytes
          for (let i = 0; i < canvas.height; ++i) {
            for (let k = 0; k < canvas.width / 8; ++k) {
              let k8 = k * 8;
              //  Pixel to bit position mapping
              printData[++offset] = getDarkPixel(k8 + 0, i) * 128 + getDarkPixel(k8 + 1, i) * 64 +
                          getDarkPixel(k8 + 2, i) * 32 + getDarkPixel(k8 + 3, i) * 16 +
                          getDarkPixel(k8 + 4, i) * 8 + getDarkPixel(k8 + 5, i) * 4 +
                          getDarkPixel(k8 + 6, i) * 2 + getDarkPixel(k8 + 7, i);
            }
          }
          return printData;
        }

        function handleError(error) {
          console.log(error);
          progress.hidden = true;
          printCharacteristic = null;
          dialog.open();
        }

        function sendNextImageDataBatch(resolve, reject) {
          // Can only write 512 bytes at a time to the characteristic
          // Need to send the image data in 512 byte batches
          if (index + 512 < data.length) {
            printCharacteristic.writeValue(data.slice(index, index + 512)).then(() => {
              index += 512;
              sendNextImageDataBatch(resolve, reject);
            })
            .catch(error => reject(error));
          } else {
            // Send the last bytes
            if (index < data.length) {
              printCharacteristic.writeValue(data.slice(index, data.length)).then(() => {
                resolve();
              })
              .catch(error => reject(error));
            } else {
              resolve();
            }
          }
        }

        function sendImageData() {
          index = 0;
          data = getImagePrintData();
          return new Promise(function(resolve, reject) {
            sendNextImageDataBatch(resolve, reject);
          });
        }

        function sendTextData() {
          // Get the bytes for the text
          let encoder = new TextEncoder("utf-8");
          // Add line feed + carriage return chars to text
          let text = encoder.encode(message.value + '\u000A\u000D');
          return printCharacteristic.writeValue(text).then(() => {
            console.log('Write done.');
          });
        }

        function sendPrinterData() {
          // Print an image followed by the text
          sendImageData()
          .then(sendTextData)
          .then(() => {
            progress.hidden = true;
          })
          .catch(handleError);
        }

        printButton.addEventListener('click', function () {
         
         let image = document.querySelector("#image");
         let canvas = document.createElement('canvas');
       
         canvas.width = 120;
         canvas.height = 120;
         let context = canvas.getContext("2d");
         context.drawImage(image, 0, 0, canvas.width, canvas.height);
         let imageData = context.getImageData(0, 0, canvas.width, canvas.height).data;
         progress.hidden = false;

          if (printCharacteristic == null) {
            navigator.bluetooth.requestDevice({
              filters: [{
                services: ['000018f0-0000-1000-8000-00805f9b34fb']
              }]
            })
            .then(device => {
              console.log('> Found ' + device.name);
              console.log('Connecting to GATT Server...');
              return device.gatt.connect();
            })
            .then(server => server.getPrimaryService("000018f0-0000-1000-8000-00805f9b34fb"))
            .then(service => service.getCharacteristic("00002af1-0000-1000-8000-00805f9b34fb"))
            .then(characteristic => {
              // Cache the characteristic
              printCharacteristic = characteristic;
              sendPrinterData();
            })
            .catch(handleError);
          } else {
            sendPrinterData();
          }
        });
      });
    </script>
  </body>
</html>
