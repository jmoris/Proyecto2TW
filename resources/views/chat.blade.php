<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <title>Web Socket Demo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/a9e2872d38.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
       <style>
            .message-box {
                margin-top: 5px;
                border-bottom: 1px solid gainsboro;
            }

            .author {
                font-size: 0.9em;
            }

            .message {
                margin-left: .5em;
                font-size: .8em;
                margin-bottom: 5px;
            }
        </style>
    </head>
    <body>
        <div class="container mt-4">
            <div class="row">
                <div class="border rounded offset-md-3 col-md-6">
                    <div class="row mt-2">
                        <div class="col">
                            <legend>Chat</legend>
                        </div>
                        <div class="col">
                            Nick:&nbsp;&nbsp;<input value="Persona" id="authorTxt" class="d-inline form-control form-control-sm" style="width: 75%;" type="text"/>
                        </div>
                    </div>    
                    
                    <div class="col-md-12" id="chat">
                        
                    </div>
                    <div class="col-md-12 mt-3 mb-3">
                        <form>
                            <textarea class="form-control" rows="2" id="message"></textarea>
                            <br />
                            <button type="submit" class="btn btn-primary">Enviar mensaje</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const connection = new WebSocket('ws://proyectotw3.herokuapp.com');

            connection.onopen = () => {
                console.log('connected');
                var html = `
                    <div class="message-box">
                        <p class="message"><i class="fas fa-arrow-right text-muted">&nbsp;</i>Conectado al chat...</p>
                    </div>
                `;
                let element = document.getElementById('chat').innerHTML;
                $('#chat').html($('#chat').html() + html);
            };

            connection.onclose = () => {
                var html = `
                <div class="message-box">
                    <p class="message"><i class="fas fa-arrow-right text-muted">&nbsp;</i>Desconectado del chat...</p>
                </div>
                `;
                let element = document.getElementById('chat').innerHTML;
                $('#chat').html($('#chat').html() + html);
            };

            connection.onerror = error => {
                var html = `
                <div class="message-box">
                    <p class="message"><i class="fas fa-arrow-right text-muted">&nbsp;</i>Error conectando al chat...</p>
                </div>
                `;
                let element = document.getElementById('chat').innerHTML;
                $('#chat').html($('#chat').html() + html);
            };

            connection.onmessage = event => {
                console.log('received', event.data);
                var data = JSON.parse(event.data);
                var html = `
                    <div class="message-box">
                        <span class="author">${data.author} (${data.date})</span>
                        <p class="message"><i class="fas fa-arrow-right text-muted">&nbsp;</i>${data.msg}</p>
                    </div>
                `;
                let element = document.getElementById('chat').innerHTML;
                $('#chat').html($('#chat').html() + html);
            };

            document.querySelector('form').addEventListener('submit', event => {
                event.preventDefault();
                let message = document.querySelector('#message').value;
                let author = $('#authorTxt').val();
                var dt = {
                    msg: message,
                    author: author,
                    date: moment().format('lll')
                };
                connection.send(JSON.stringify(dt));
                document.querySelector('#message').value = '';
            });
        </script>
    </body>
</html>