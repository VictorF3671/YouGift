import { Component } from '@angular/core';
import { IonApp, IonRouterOutlet } from '@ionic/angular/standalone';
import { addIcons } from 'ionicons';
import { home, settings, person, idCard, addOutline, personCircleOutline, trashOutline, settingsOutline } from 'ionicons/icons';

addIcons({ home, settings , person, addOutline, idCard, personCircleOutline, trashOutline, settingsOutline });
@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  imports: [IonApp, IonRouterOutlet],
})
export class AppComponent {
  constructor() {}
}
