
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/web3/4.6.0/web3.min.js" integrity="sha512-DTSUnB4owPx74KyQnBL+XPSCI8elZpjR0dnHmSnHkmTirIzI/9ANYxuDZ87TVsQ1E+8rQB/V4EAaUfKN+h42+w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </head>
    <body>
	<form action="verified.php" method="post" id="myForm">
    <!-- Other form fields here -->
    <input type="hidden" name="verified" id="verified" value="">
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
const email =<?php echo json_encode($_SESSION['email']); ?>;
console.log(email);
const ethAddress = account; // Ethereum address
contract.methods.doesEmailExist(email).call()
    .then(function(exists){
        if (exists) {
            alert('Email already exists');
			window.location.href = '../../index.php';
            // Stop further execution
            throw new Error('Email already exists');
			
        } else {
            contract.methods.storeEmail(email, ethAddress).send({ from: account })
    .on('transactionHash', function(hash){
        console.log('Transaction Hash:', hash);
		alert('Registration succesfull..');
		document.getElementById('verified').value = 'yes';
    	document.getElementById('myForm').submit();
		
    })
    .on('receipt', function(receipt){
        console.log('Receipt:', receipt);
    })
    .on('error', function(error){
        console.error('Error:', error);
    });
	
        }
    })
    .catch(function(error){
        console.error('Error:', error);
    });


			}



			// for deleting the email
			const Connect2 = async()=>{
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

contract.methods.doesEmailExist(email).call()
    .then(function(exists){
        if (exists) {
            contract.methods.getEmailAddress(email).call()
			.then(function(ethAddress){
				if(account.toLowerCase() == ethAddress.toLowerCase()){
						contract.methods.removeEmail(email).send({ from: account })
							.on('transactionHash', function(hash){
								alert("Account deletion succesfull  ");
								setTimeout(function() {
									window.location.href = 'index.php';
								}, 1000);
							})
							.on('receipt', function(receipt){
								console.log('Receipt:', receipt);
							})
							.on('error', function(error){
								console.error('Error1:', error);
							});
				} else {
					alert("Authentication Failed..can't delete the account  ");
					setTimeout(function() {
						window.location.href = 'index.php';
					}, 1000);
				}
					})
					.catch(function(error){
						console.error('Error2:', error);
					});
        } else {
			alert("Email does not exist  ");
					setTimeout(function() {
						window.location.href = 'index.php';
					}, 1000);
        }
    })
    .catch(function(error){
        console.error('Error3:', error);
    });



			}


    </script>
    </body>
</html>
<?php
if(isset($_SESSION["submit"])){
     
    // $_SESSION['email']=$email;

    
        echo "<script>Connect();</script>";

}else{
	echo "not set";
}

if(isset($_POST["delete"])){
    
    $email=$_POST["email"];
    

    
    $_SESSION['email']=$email;
    

    
	echo "<script>Connect2();</script>";

}
?>