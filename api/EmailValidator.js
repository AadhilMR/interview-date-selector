export class EmailValidator {
    SECRET_KEY = "1234567890123456";
    TOKEN = null;
    IV = new TextEncoder().encode("1234567891017180");
    
    constructor(token) {
        if(token == null) {
            throw new Error("Token is required!");
        }
        this.TOKEN = token;
    }

    async validateToken() {
        return await this.decodeToken();
    }

    async decodeToken() {
        // Decode the token and IV from base64 to bytes
        const encryptedData = Uint8Array.from(atob(this.TOKEN), c => c.charCodeAt(0));    
    
        // Import the secret key for AES decryption
        const cryptoKey = await window.crypto.subtle.importKey(
            "raw",
            new TextEncoder().encode(this.SECRET_KEY),
            { name: "AES-CTR", length: 128 },
            false,
            ["decrypt"]
        );

        try {
            const decryptedData = await window.crypto.subtle.decrypt(
                { name: "AES-CTR", counter: this.IV, length: 128 },
                cryptoKey,
                encryptedData
            );

            // Convert the decrypted bytes to a string
            return new TextDecoder().decode(decryptedData);
        } catch (error) {
            console.error("Error decrypting the token: ", error);
            return false;
        }
    }
}