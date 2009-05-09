function shake_ram(shakes, vibration) {

    for (i = shakes; i > 0; i--) {

        self.moveBy(i, vibration);

        self.moveBy(-i, -vibration);
    }
}
