import os
import firebase_admin
from firebase_admin import credentials, firestore, auth, storage, messaging

FIREBASE_CREDENTIALS_PATH = os.path.join(
    os.path.dirname(__file__), "../secret/firebase_credentials.json"
)

cred = credentials.Certificate(FIREBASE_CREDENTIALS_PATH)

if not firebase_admin._apps:
    firebase_app = firebase_admin.initialize_app(
        cred,
        {
            "storageBucket": "<SEU_BUCKET>.appspot.com", 
        },
    )

firestore_db = firestore.client()
firebase_auth = auth
firebase_storage = storage.bucket()
firebase_messaging = messaging