
<!DOCTYPE html>

<html>
<head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/web3/4.6.0/web3.min.js" integrity="sha512-DTSUnB4owPx74KyQnBL+XPSCI8elZpjR0dnHmSnHkmTirIzI/9ANYxuDZ87TVsQ1E+8rQB/V4EAaUfKN+h42+w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </head>
    <body>
	<form action="verified.php" method="post" id="myForm">
    <!-- Other form fields here -->
    <input type="hidden" name="authenticated" id="authenticated" value="">
</form>

		<?php
			session_start();
		?>
    <script>
		let account;
		let contract;
            const Connect = async()=>{
                if(typeof window.ethereum!=="undefined"){
                    const accounts=await ethereum.request({method: "eth_requestAccounts"});
                    account=accounts[0];
                    console.log(account);
                }
                const ABI = [
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"internalType": "string",
				"name": "email",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "address",
				"name": "ethAddress",
				"type": "address"
			}
		],
		"name": "EmailRemoved",
		"type": "event"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"internalType": "string",
				"name": "email",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "address",
				"name": "ethAddress",
				"type": "address"
			}
		],
		"name": "EmailStored",
		"type": "event"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"internalType": "string",
				"name": "email",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "address",
				"name": "ethAddress",
				"type": "address"
			}
		],
		"name": "EmailUpdated",
		"type": "event"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "email",
				"type": "string"
			}
		],
		"name": "removeEmail",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "email",
				"type": "string"
			},
			{
				"internalType": "address",
				"name": "ethAddress",
				"type": "address"
			}
		],
		"name": "storeEmail",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "email",
				"type": "string"
			},
			{
				"internalType": "address",
				"name": "ethAddress",
				"type": "address"
			}
		],
		"name": "updateEmail",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "email",
				"type": "string"
			}
		],
		"name": "doesEmailExist",
		"outputs": [
			{
				"internalType": "bool",
				"name": "",
				"type": "bool"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "email",
				"type": "string"
			}
		],
		"name": "getEmailAddress",
		"outputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"stateMutability": "view",
		"type": "function"
	}
];
                const address = "0xBb3b7AF518683312Ded2587c502d7DaEBD25EE78";
                window.web3=await new Web3(window.ethereum);
                contract = window.contract = await new window.web3.eth.Contract(ABI,address);
                console.log("contract is connected");
            

// Example function call to store an email
const email = <?php echo json_encode($_SESSION['email']); ?>;
console.log(email);
// Ethereum address

contract.methods.getEmailAddress(email).call()
    .then(function(ethAddress){
        if(account.toLowerCase() == ethAddress.toLowerCase()){
            // alert("Authentication success..");
            setTimeout(function() {
                document.getElementById('authenticated').value = 'yes';
    			document.getElementById('myForm').submit();
            }, 1000); // Redirect after 1 second
        } else {
            alert("BlockChain Authentication Failed ");
            setTimeout(function() {
                window.location.href = '../../index.php';
            }, 1000); // Redirect after 1 second
        }
    })
    .catch(function(error){
        alert("Email not registered..please Sign Up");
            setTimeout(function() {
                window.location.href = '../../index.php';
            }, 1000);
    });


			}
    </script>

    <?php
    echo "<script>Connect();</script>";

?>
    </body>
</html>