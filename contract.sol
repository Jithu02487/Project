// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

contract EmailStorage {
    struct EmailData {
        address ethAddress;
        bool exists;
    }

    mapping(string => EmailData) private emailMapping;

    event EmailStored(string email, address ethAddress);
    event EmailUpdated(string email, address ethAddress);
    event EmailRemoved(string email, address ethAddress);

    function storeEmail(string memory email, address ethAddress) public {
        require(ethAddress != address(0), "Invalid Ethereum address");
        emailMapping[email] = EmailData(ethAddress, true);
        emit EmailStored(email, ethAddress);
    }

    function updateEmail(string memory email, address ethAddress) public {
        require(ethAddress != address(0), "Invalid Ethereum address");
        require(emailMapping[email].exists, "Email does not exist");
        emailMapping[email].ethAddress = ethAddress;
        emit EmailUpdated(email, ethAddress);
    }

    function removeEmail(string memory email) public {
        require(emailMapping[email].exists, "Email does not exist");
        delete emailMapping[email];
        emit EmailRemoved(email, msg.sender);
    }

    function getEmailAddress(string memory email) public view returns (address) {
        require(emailMapping[email].exists, "Email does not exist");
        return emailMapping[email].ethAddress;
    }

    function doesEmailExist(string memory email) public view returns (bool) {
        return emailMapping[email].exists;
    }
}
